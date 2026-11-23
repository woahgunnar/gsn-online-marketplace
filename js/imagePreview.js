document.addEventListener("DOMContentLoaded", () => {
    const urlInput = document.getElementById("image_url");
    const preview = document.getElementById("imagePreview");
    const message = document.getElementById("previewMessage");

    if (!urlInput || !preview || !message) {
        return;
    }

    urlInput.addEventListener("input", () => {
        const imageURL = urlInput.value.trim();

        // Reset the previous preview.
        preview.hidden = true;
        preview.removeAttribute("src");

        if (imageURL === "") {
            message.textContent = "Enter an image URL to see a preview.";
            return;
        }

        // Only allow HTTPS URLs.
        let parsedURL;

        try {
            parsedURL = new URL(imageURL);
        } catch {
            message.textContent = "Please enter a valid image URL.";
            return;
        }

        if (parsedURL.protocol !== "https:") {
            message.textContent = "Image URLs must use HTTPS.";
            return;
        }

        message.textContent = "Loading image...";

        // Display the image only if it loads successfully.
        preview.onload = () => {
            preview.hidden = false;
            message.textContent = "Image loaded successfully!";
        };

        preview.onerror = () => {
            preview.hidden = true;
            message.textContent =
                "Unable to load this image. Check the URL or try another image.";
        };

        preview.src = parsedURL.href;
    });
});
