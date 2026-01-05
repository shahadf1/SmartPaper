import sys
from inference import verify_signature

sig1 = sys.argv[1]
sig2 = sys.argv[2]

prob = verify_signature(sig1, sig2)
print(prob)
