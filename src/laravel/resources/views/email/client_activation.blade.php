<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Активация аккаунта</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #777;
        }
        .link-box {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 20px 0;
            word-break: break-all;
            font-size: 14px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Активация аккаунта</h1>
    </div>

    <div class="content">
        <p>Здравствуйте, {{ $client->login ?? 'Уважаемый пользователь' }}!</p>
        
        <p>Благодарим вас за регистрацию в нашей системе. Для завершения регистрации необходимо активировать ваш аккаунт.</p>
        
        <p style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">
                АКТИВИРОВАТЬ АККАУНТ
            </a>
        </p>
        
        <p>Если кнопка не работает, скопируйте и вставьте следующую ссылку в адресную строку браузера:</p>
        
        <div class="link-box">
            {{ $activationUrl }}
        </div>
        
        <div class="warning">
            <p><strong>Важно:</strong></p>
            <ul>
                <li>Ссылка действительна в течение 24 часов</li>
                <li>Если вы не регистрировались в системе, проигнорируйте это письмо</li>
                <li>Проверьте папку "Спам", если не видите письмо</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Это письмо отправлено автоматически. Пожалуйста, не отвечайте на него.</p>
        <p>© {{ date('Y') }} Система бронирования. Все права защищены.</p>
        <p>
            Служба поддержки: 
            <a href="mailto:support@example.com">support@example.com</a>
        </p>
    </div>
</body>
</html>