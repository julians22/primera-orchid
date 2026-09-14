<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f6; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #333333;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
                    
                    <tr>
                        <td align="left" style="background-color: #113a3e; padding: 30px 40px;">
                            <h1 style="color: #ffffff; font-size: 20px; font-weight: 600; margin: 0; tracking-spacing: 0.5px;">
                                New Contact Form Submission
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 24px 0; font-size: 15px; line-height: 1.5; color: #555555;">
                                You have received a new message from the contact form on your website. Here are the details:
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td width="120" style="padding: 8px 0; font-size: 14px; font-weight: bold; color: #113a3e; vertical-align: top;">Name:</td>
                                    <td style="padding: 8px 0; font-size: 14px; color: #333333; vertical-align: top;">{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <td width="120" style="padding: 8px 0; font-size: 14px; font-weight: bold; color: #113a3e; vertical-align: top;">Email:</td>
                                    <td style="padding: 8px 0; font-size: 14px; color: #333333; vertical-align: top;">
                                        <a href="mailto:{{ $contact->email }}" style="color: #113a3e; text-decoration: underline;">{{ $contact->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="120" style="padding: 8px 0; font-size: 14px; font-weight: bold; color: #113a3e; vertical-align: top;">Phone:</td>
                                    <td style="padding: 8px 0; font-size: 14px; color: #333333; vertical-align: top;">{{ $contact->contact }}</td>
                                </tr>
                            </table>

                            <div style="border-top: 1px solid #eef2f1; margin: 20px 0;"></div>

                            <div style="margin-top: 24px;">
                                <span style="font-size: 14px; font-weight: bold; color: #113a3e; display: block; margin-bottom: 8px;">Message:</span>
                                <div style="background-color: #f8faf9; border-left: 4px solid #113a3e; padding: 16px 20px; border-radius: 4px; font-size: 14px; line-height: 1.6; color: #444444; white-space: pre-line;">{{ $contact->message }}</div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f8faf9; padding: 20px 40px; border-top: 1px solid #eef2f1;">
                            <p style="margin: 0; font-size: 12px; color: #888888; text-align: center;">
                                This is an automated email sent from your website's contact form.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>