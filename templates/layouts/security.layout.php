<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXIT-SA - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* === Variables globales === */
        :root {
            --primary-color: #1f2937;
            --primary-hover: #374151;
            --background-color: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #d1d5db;
            --input-focus: #3b82f6;
            --success-color: #10b981;
            --error-color: #ef4444;
        }

        /* === Couleurs et fonds === */
        .custom-primary {
            background-color: var(--primary-color);
        }

        .custom-primary:hover {
            background-color: var(--primary-hover);
        }

        .custom-bg {
            background-color: var(--background-color);
        }

        .custom-text {
            color: var(--text-primary);
        }

        .custom-text-secondary {
            color: var(--text-secondary);
        }

        .custom-border {
            border-color: var(--border-color);
        }

        .custom-focus:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* === Upload area === */
        .upload-area {
            border: 2px dashed var(--border-color);
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: var(--input-focus);
            background-color: rgba(59, 130, 246, 0.05);
        }

        .upload-area.dragover {
            border-color: var(--input-focus);
            background-color: rgba(59, 130, 246, 0.1);
        }

        .uploaded-image {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            border: 2px solid var(--success-color);
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: var(--error-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }

        /* === Formulaire de connexion === */
        .login-container {
            max-width: 500px;
            margin: 0 auto;
        }

        .connexion-title {
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: 0.1em;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-field {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s ease;
            background-color: white;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .input-field::placeholder {
            color: var(--text-secondary);
        }

        .btn-primary {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .signup-link {
            color: var(--input-focus);
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }

        /* === Loading + Spinner === */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .spinner {
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>


</head>

<body class="custom-bg min-h-screen py-8 px-4 flex justify-center items-center">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block custom-primary text-white px-12 py-8 rounded-bl-3xl rounded-tl-xl rounded-tr-3xl mb-6">
                <h1 class="text-xl font-bold">MAXIT-SA</h1>
            </div>
            <h2 class="text-2xl font-bold custom-text mb-2">BIENVENUE SUR MAXIT-SA</h2>
        </div>
        <?php echo $content ?>
    </div>

</body>

</html>