import torch
from PIL import Image
import torchvision.transforms as T
from models import SiameseNet

device = torch.device("cpu")

def load_model():
    model = SiameseNet().to(device)
    checkpoint = torch.load("ml/siamese_signature_model.pth", map_location=device)
    model.load_state_dict(checkpoint["model_state"], strict=True)
    model.eval()
    return model

transform = T.Compose([
    T.Grayscale(1),
    T.Resize((128, 128)),
    T.ToTensor(),
    T.Normalize((0.5,), (0.5,))
])

def preprocess(path):
    img = Image.open(path).convert("RGB")
    return transform(img).unsqueeze(0).to(device)

def verify_signature(sig1, sig2):
    model = load_model()
    x1 = preprocess(sig1)
    x2 = preprocess(sig2)

    with torch.no_grad():
        prob, _, _ = model(x1, x2)

    return float(prob.item())
