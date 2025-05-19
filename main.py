import cv2
import os
import tkinter as tk
from tkinter import filedialog
import torch
from realesrgan import RealESRGAN

def upscale_image(image_path, save_path):
    device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
    model = RealESRGAN(device, scale=4)
    model.load_weights('weights/RealESRGAN_x4.pth', download=True)

    image = cv2.imread(image_path)
    if image is None:
        print(f"Failed to load {image_path}")
        return

    # Convert OpenCV image to RGB (required by Real-ESRGAN)
    image = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    upscaled_image = model.predict(image)

    # Convert back to BGR before saving
    upscaled_image = cv2.cvtColor(upscaled_image, cv2.COLOR_RGB2BGR)
    cv2.imwrite(save_path, upscaled_image)
    print(f"Upscaled image saved to: {save_path}")

def select_file():
    file_path = filedialog.askopenfilename(filetypes=[("Image Files", "*.jpg;*.jpeg;*.png")])
    if file_path:
        save_path = filedialog.asksaveasfilename(defaultextension=".png", filetypes=[("PNG files", "*.png"), ("JPEG files", "*.jpg"), ("All Files", "*.*")])
        if save_path:
            upscale_image(file_path, save_path)

def main():
    root = tk.Tk()
    root.title("AI Image Upscaler")
    root.geometry("300x150")

    btn_select = tk.Button(root, text="Select Image", command=select_file)
    btn_select.pack(pady=20)

    root.mainloop()

if __name__ == "__main__":
    main()
