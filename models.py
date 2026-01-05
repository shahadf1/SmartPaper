import torch
import torch.nn as nn
from torchvision import models
import torch.nn.functional as F

class SiameseNet(nn.Module):
    def __init__(self, embedding_dim=128):
        super().__init__()

        # Load ResNet18 backbone
        self.backbone = models.resnet18()

        # Modify first conv layer to accept 1-channel grayscale
        self.backbone.conv1 = nn.Conv2d(
            1, 64, kernel_size=7, stride=2, padding=3, bias=False
        )

        # Replace final FC layer
        self.backbone.fc = nn.Linear(512, embedding_dim)

        # Head (matches checkpoint keys: head.0, head.2)
        self.head = nn.Sequential(
            nn.Linear(embedding_dim, 64),
            nn.ReLU(),
            nn.Linear(64, 1),
            nn.Sigmoid()
        )

    def forward(self, x1, x2):
        emb1 = self.backbone(x1)
        emb2 = self.backbone(x2)

        diff = torch.abs(emb1 - emb2)
        prob = self.head(diff)

        return prob.squeeze(), emb1, emb2
