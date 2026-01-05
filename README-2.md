SmartPaper – Intelligent Signature Verification System

SmartPaper is a web-based application that collects user information, captures digital signatures, and verifies new signatures using a machine learning model based on a Siamese Neural Network.

The system simulates a government identification workflow where a user fills in personal details, provides a reference signature, and later verifies their identity by submitting a second signature for comparison.

Features
1. Multi-Step Form Process

Step 1: User enters personal information.

Step 2: User provides an initial signature (reference signature).

Step 3: User provides a second signature for verification.

2. Digital Signature Capture

Signature is drawn on an HTML canvas.

Automatically converted to a Base64 PNG image.

Stored in the server under uploads/signatures/.

3. Backend System (PHP + MySQL)

Stores applicant information in the applicants table.

Stores reference and verification signatures in the signatures table.

Maintains data flow between form pages and verification logic.

4. Machine Learning Signature Verification

Located in the /ml/ directory.

Uses a PyTorch Siamese Neural Network (.pth model).

Compares two signatures and returns a probability score.

Determines whether the signatures belong to the same person.

5. API Endpoint (Optional)

A PHP endpoint can call the Python inference script to:

Load two signatures.

Run them through the ML model.

Return a similarity result.

Project Structure
smart-paper/
│
├── backend/
│   ├── db.php
│   ├── save_applicant.php
│   ├── upload_signature.php
│   ├── upload_new_signature.php
│   └── verify_signature.php
│
├── frontend/
│   ├── form/
│   │   ├── index.php
│   │   ├── form-card.php
│   │   ├── verification.html
│   │   ├── style.css
│   │   └── main.js
│   │
│   └── dashboard/ (future extension)
│
├── uploads/
│   └── signatures/
│
├── ml/
│   ├── models.py
│   ├── inference.py
│   ├── test_inference.py
│   └── siamese_signature_model.pth
│
└── README.md

Machine Learning Model
Model Architecture

Siamese Neural Network using a ResNet18-based encoder.

Input images are grayscale (1 channel), resized to 128×128.

Outputs a probability between 0 and 1 representing match likelihood.

Preprocessing Steps

Convert image to grayscale.

Resize to 128×128 pixels.

Normalize using mean = 0.5 and std = 0.5.

Technology Stack
Component	Technology
Frontend	HTML, CSS, JavaScript (Canvas Signature Pad)
Backend	PHP 8 with XAMPP
Database	MySQL (via phpMyAdmin)
ML Model	Python, PyTorch
Version Control	Git and GitHub
Installation and Setup
1. Clone the repository
git clone https://github.com/yourusername/smart-paper
cd smart-paper

2. Configure the database

Create two tables:

applicants

signatures

Add database credentials in /backend/db.php.

3. Install machine-learning dependencies
pip install torch torchvision pillow

4. Test the model
python ml/test_inference.py

5. Run the website using XAMPP

Place the project folder inside:

C:\xampp\htdocs\smart-paper


Start:

Apache

MySQL

Open:

http://localhost/smart-paper/frontend/form/index.php

Verification Workflow

User fills the form (index.php).

User provides the reference signature (form-card.php).

Signature is saved in uploads/signatures/ and database.

User is redirected to verification.html.

User provides a new signature.

Backend compares the two signatures using the Siamese model.

Result page displays whether the signature matches or not.

Future Improvements

Admin dashboard for browsing applicants and signatures.

Role-based authentication.

Deployment of ML model as a microservice (Flask or FastAPI).

Enhanced accuracy with improved neural architectures.

Email-based verification workflow.

Contributors

Lujain – Backend developer
Hannen - Frontend developer
Shahad – Machine learning developer
