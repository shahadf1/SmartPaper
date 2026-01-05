from inference import verify_signature

prob = verify_signature(
    r"C:\xampp\htdocs\smart-paper\uploads\signatures\signature_1_1765509595.png",
    r"C:\xampp\htdocs\smart-paper\uploads\signatures\signature_1_1765509854.png"
)

print("Probability:", prob)
