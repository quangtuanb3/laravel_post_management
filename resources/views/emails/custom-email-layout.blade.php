<!DOCTYPE html>
<html>

<head>
    <title>{{ $title ?? config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        header,
        footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        h4 {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <!-- Header content goes here -->
        BAP LOGO
    </header>
    <main>
        <h4>Hello {{ $username }},</h4>
        <p>Please click the button below to activate your account:</p>
        <a href="{{ $url }}"
            style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Activate
            account</a>
        <p style="padding: 10px 0"> This verification link will expire in {{ config('auth.verification.expire', 60) }}
            minutes.</p>
        <p style="padding-top:10px">Support Email:</p>
        <p>
            <a href="mailto:{{ config('app.support-email') }}">
                {{ config('app.support-email') }}
            </a>
        </p>
    </main>
    <footer>
        <!-- Footer content goes here -->
        © {{ date('Y') }} BAP Hue. All rights reserved.
    </footer>
</body>

</html>
