from PIL import Image
from io import BytesIO
import numpy as np
import pywt
from fastapi import FastAPI, File, UploadFile
from fastapi.responses import JSONResponse
import joblib
import cv2
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

# Enable CORS for all origins (for testing purposes)
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Change this to your frontend URL in production
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)




model = joblib.load('gradproj.pkl')
model2 = joblib.load('DTgradproject2.pkl')


def read_image_as_pil(image_bytes):
    return Image.open(BytesIO(image_bytes))

def pil_to_numpy(image: Image.Image):
    image = image.convert("L")  # Convert to grayscale
    return np.array(image, dtype=np.float32)  # Convert to NumPy array


def wavelet_transform_single(img, wavelet='db4', level=3, dtype=np.float32):
 
    coeffs = pywt.wavedec2(img, wavelet=wavelet, level=level)

   
    coeffs_flat = np.concatenate([
        c.flatten() if isinstance(c, np.ndarray) else np.concatenate([x.flatten() for x in c]) 
        for c in coeffs
    ])

    return coeffs_flat.astype(dtype)


def preprocess_image(image: Image.Image, target_size=(128, 128)):
    # Convert PIL Image to NumPy array
    img_array = np.array(image)  

    # Ensure the image is in grayscale
    if len(img_array.shape) == 3:  # If RGB, convert to grayscale
        img_array = cv2.cvtColor(img_array, cv2.COLOR_RGB2GRAY)

    # Resize using OpenCV (cv2)
    img_resized = cv2.resize(img_array, target_size)

    # Apply wavelet transform
    img_wavelet_features = wavelet_transform_single(img_resized, level=3)

    # Use the trained model to make a prediction
    prediction = model.predict([img_wavelet_features])  # Ensure it's inside a list
    class_names = ["Covid", "Viral Pneumonia", "Normal"]
    predicted_class = class_names[prediction[0]]  # Convert label to class name

    print(f"Predicted class for the input image: {predicted_class}")

    return predicted_class


    

@app.post("/predict/")
async def predict(file: UploadFile = File(...)):
    # Read image file
    image_bytes = await file.read()
    image = read_image_as_pil(image_bytes)

    result = preprocess_image(image)


    return JSONResponse(content={"output": result})  # Convert NumPy output to JSON
