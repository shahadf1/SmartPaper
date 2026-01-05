function validateLength(input, errorElement) {
    const value = input.value;

    // منع إدخال غير الأرقام
    input.value = value.replace(/\D/g, "");

    if (input.value.length === 10) {
        errorElement.textContent = ""; // تختفي الرسالة فورًا
        
    } else {
        errorElement.textContent = "يجب أن يتكون من 10 أرقام";
    }
}

// للتحقق أثناء الكتابة — بدون ما يشيل الماوس
const phoneField = document.getElementById("Phone");
if (phoneField) {
    const phoneError = document.getElementById("phone-error");
    phoneField.addEventListener("input", function () {
        validateLength(this, phoneError);
    });
}

document.querySelectorAll(".national-id").forEach(function(field) {
    field.addEventListener("input", function() {
        const error = document.getElementById(this.dataset.error);
        validateLength(this, error);
    });
});

//التوقيع


// نجيب كل مجموعات التوقيع
const signaturePads = document.querySelectorAll(".signature-pad");

signaturePads.forEach((canvas) => {
    const ctx = canvas.getContext("2d");

    // نجيب العناصر المرتبطة بكل Canvas
    const clearBtn = canvas.parentElement.querySelector(".clear-signature");
    const signatureData = canvas.parentElement.querySelector(".signature-data");

    let drawing = false;

    function getPosition(event) {
        const rect = canvas.getBoundingClientRect();
        return {
            x: (event.touches ? event.touches[0].clientX : event.clientX) - rect.left,
            y: (event.touches ? event.touches[0].clientY : event.clientY) - rect.top
        };
    }

    function startDrawing(event) {
        drawing = true;
        const pos = getPosition(event);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }

    function draw(event) {
        if (!drawing) return;
        const pos = getPosition(event);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDrawing() {
        drawing = false;
        signatureData.value = canvas.toDataURL(); // يحفظ التوقيع الصحيح للكانفس الصحيح
    }

    // Events for mouse
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseleave", stopDrawing);

    // Events for touch
    canvas.addEventListener("touchstart", startDrawing);
    canvas.addEventListener("touchmove", draw);
    canvas.addEventListener("touchend", stopDrawing);

    // زر المسح
    clearBtn.addEventListener("click", () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        signatureData.value = "";
    });
});