<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد البريد الإلكتروني - LuxeSpace</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f3ef !important;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        table {
            border-collapse: collapse;
        }
        .btn-login:hover {
            background-color: #73604f !important;
        }
    </style>
</head>
<body style="background-color: #f4f3ef; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 40px 20px; direction: rtl; text-align: right;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px; margin: 0 auto; background-color: #eae8e1; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        
        <tr>
            <td align="center" style="padding: 40px 35px 20px 35px;">
                <a href="{{ url('/') }}" style="font-family: 'Playfair Display', 'Times New Roman', serif; font-size: 34px; font-weight: bold; font-style: italic; color: #2a2a2a; text-decoration: none;">
                    LuxeSpace
                </a>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 10px 35px;">
                <div style="font-size: 55px; color: #8c7662; line-height: 1;">
                    ✉
                </div>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 10px 35px 20px 35px;">
                <h2 style="font-size: 20px; font-weight: 600; color: #2a2a2a; margin: 0;">
                    تأكيد حسابك الرقمي
                </h2>
            </td>
        </tr>

        <tr>
            <td style="padding: 10px 35px 25px 35px; color: #606060; font-size: 15px; line-height: 1.8; text-align: right;">
                <p style="font-weight: bold; color: #2a2a2a; margin-top: 0; margin-bottom: 12px;">
                    أهلاً بك، {{ $user->name ?? 'عميلنا العزيز' }}!
                </p>
                <p style="margin: 0;">
                    يسعدنا انضمامك إلى مجتمع **LuxeSpace**. لتفعيل حسابك والبدء في استكشاف وتصميم مساحتك الفاخرة، يرجى تأكيد بريدك الإلكتروني بالضغط على الزر الفاخر أدناه.
                </p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 0 35px 35px 35px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center">
                            <a href="{{ $url }}" class="btn-login" style="display: block; background-color: #8c7662; color: #ffffff; text-decoration: none; padding: 15px 30px; font-size: 15px; font-weight: 600; border-radius: 12px; box-shadow: 0 4px 15px rgba(140, 118, 98, 0.15); transition: background-color 0.3s ease; text-align: center;">
                                تأكيد البريد الإلكتروني
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding: 25px 35px 35px 35px; border-top: 1px solid rgba(0,0,0,0.06); font-size: 12px; color: #808080; text-align: center;">
                <p style="margin-top: 0; margin-bottom: 15px; line-height: 1.6; text-align: right;">
                    إذا واجهتك مشكلة في الضغط على الزر، يمكنك نسخ الرابط التالي ولصقه في متصفحك مباشرة:
                    <br>
                    <a href="{{ $url }}" style="color: #8c7662; word-break: break-all; font-size: 11px; text-decoration: none;">{{ $url }}</a>
                </p>
                <p style="margin-bottom: 0; margin-top: 20px; font-size: 11px; color: #a0a0a0;">
                    هذه الرسالة أرسلت تلقائياً من LuxeSpace. © 2026 جميع الحقوق محفوظة.
                </p>
            </td>
        </tr>

    </table>

</body>
</html>