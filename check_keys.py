import torch

checkpoint = torch.load("ml/siamese_signature_model.pth", map_location="cpu")

print("Checkpoint keys:")
for k in checkpoint.keys():
    print(" -", k)