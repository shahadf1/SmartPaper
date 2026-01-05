<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج إصدار هوية وطنية</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="layout">
    <h2>الهوية وطنية</h2>

    <!-- التبويبات -->
    <div class="tabs">
        <div class="tab active" id="tab-issue">اصدار هوية وطنية</div>
        <div class="tab" id="tab-renew">طلب تجديد هوية</div>
        <div class="tab" id="tab-lost">طلب هوية بدل مفقود</div>
        <div class="tab" id="tab-damaged">طلب هوية بدل تالفة</div>
    </div>

    <!-- NOTE: This form now sends data to backend/save_applicant.php -->
    <form id="id-form" action="../../backend/save_applicant.php" method="POST">
        <fieldset>
            <legend><h2>أولاً: معلومات عن صاحب الطلب</h2></legend>

            <div class="grid">

                <div class="form-group">
                    <label>الاسم كما هو مدون بالهوية الوطنية:</label>
                    <input type="text" id="full-name" name="fullName" required>
                </div>

                <div class="form-group">
                    <label>تاريخ الميلاد:</label>
                    <input type="date" id="birth-date" name="birthDate" required>
                </div>

                <div class="form-group">
                    <label>رقم السجل المدني:</label>
                    <input type="text" maxlength="10" id="national-id" name="nationalId"
                     class="national-id" data-error="id1-error" required>
                    <small class="error-message" id="id1-error"></small>
                </div>

                <div class="form-group">
                    <label>مكان الميلاد:</label>
                    <input type="text" id="birth-place" name="birthPlace" required>
                </div>

                <div class="form-group">
                    <label>نوع الجنس:</label>
                    <div class="inline-inputs">
                        <label><input type="radio" name="gender" value="male" required> ذكر</label>
                        <label><input type="radio" name="gender" value="female"> أنثى</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>الحالة الاجتماعية:</label>
                    <div class="inline-inputs">
                        <label><input type="radio" name="maritalStatus" value="married" required> متزوج/ة</label>
                        <label><input type="radio" name="maritalStatus" value="single"> غير متزوج/ة</label>
                        <label><input type="radio" name="maritalStatus" value="divorced"> مطلقة</label>
                        <label><input type="radio" name="maritalStatus" value="widow"> أرملة</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>فصيلة الدم:</label>
                    <input type="text" id="blood-type" name="bloodType">
                </div>

                <div class="form-group">
                    <label>المؤهل:</label>
                    <input type="text" id="education" name="education">
                </div>

                <div class="form-group">
                    <label>رقم العنوان الوطني:</label>
                    <input type="text" id="address-number" name="addressNumber">
                </div>

                <div class="form-group">
                    <label>العنوان / المدينة:</label>
                    <input type="text" id="city" name="city">
                </div>

                <div class="form-group">
                    <label>الحي:</label>
                    <input type="text" id="district" name="district">
                </div>

                <div class="form-group">
                    <label>الشارع:</label>
                    <input type="text" id="street" name="street">
                </div>

                <div class="form-group">
                    <label>رقم الجوال:</label>
                    <input type="text" maxlength="10" id="Phone" name="phone">
                    <small class="error-message" id="phone-error"></small>
                </div>

                <div class="form-group">
                    <label>البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label>رقم السجل المدني للأب:</label>
                    <input type="text" maxlength="10" id="father-id" name="fatherId"
                     class="national-id" data-error="id2-error">
                    <small class="error-message" id="id2-error"></small>
                </div>

                <div class="form-group">
                    <label>اسم الأم رباعياً:</label>
                    <input type="text" id="mother-name" name="motherName">
                </div>

                <div class="form-group">
                    <label>جنسية الأم:</label>
                    <input type="text" id="mother-nationality" name="motherNationality">
                </div>

                <div class="form-group">
                    <label>رقم السجل المدني للأم:</label>
                    <input type="text" maxlength="10" id="mother-id" name="motherId"
                     class="national-id" data-error="id3-error">
                    <small class="error-message" id="id3-error"></small>
                </div>
            </div>

            <div class="buttons-container">
                <button type="submit" class="next">التالي</button>
            </div>
        </fieldset>
    </form>
</div>

<script src="main.js"></script>
</body>
</html>
