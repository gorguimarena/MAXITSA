<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXIT-SA - Finalisation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
    </style>
</head>

<body class="custom-bg min-h-screen py-8 px-4">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block custom-primary text-white px-12 py-8 rounded-bl-3xl rounded-tl-xl rounded-tr-3xl mb-6">
                <h1 class="text-xl font-bold">MAXIT-SA</h1>
            </div>
            <h2 class="text-2xl font-bold custom-text mb-2">BIENVENUE SUR MAXIT-SA</h2>
        </div>

        <!-- Form -->
        <form class="space-y-6" method="post" action="/inscription/2" enctype="multipart/form-data">
            <!-- Upload Photos Section -->
            <div>
                <label class="block text-sm font-medium custom-text mb-4">
                    Veuillez charger les photos :
                </label>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Recto -->
                    <div class="space-y-2">
                        <div class="text-center">
                            <div class="upload-area p-6 rounded-lg cursor-pointer" id="recto-upload">
                                <div class="flex flex-col items-center" id="recto-placeholder">
                                    <svg class="w-8 h-8 custom-text-secondary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span class="text-sm custom-text-secondary font-medium">Recto</span>
                                </div>
                                <div class="uploaded-image hidden" id="recto-preview">
                                    <img src="" alt="Recto" class="w-full h-24 object-cover">
                                    <button type="button" class="remove-btn" onclick="removeImage('recto')">×</button>
                                </div>
                            </div>
                            <input type="file" id="recto-input" name="cni_recto" accept="image/*" class="hidden">
                        </div>
                    </div>

                    <!-- Verso -->
                    <div class="space-y-2">
                        <div class="text-center">
                            <div class="upload-area p-6 rounded-lg cursor-pointer" id="verso-upload">
                                <div class="flex flex-col items-center" id="verso-placeholder">
                                    <svg class="w-8 h-8 custom-text-secondary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span class="text-sm custom-text-secondary font-medium">Verso</span>
                                </div>
                                <div class="uploaded-image hidden" id="verso-preview">
                                    <img src="" alt="Verso" class="w-full h-24 object-cover">
                                    <button type="button" class="remove-btn" onclick="removeImage('verso')">×</button>
                                </div>
                            </div>
                            <input type="file" id="verso-input" name="cni_verso" accept="image/*" class="hidden">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium custom-text mb-2">
                    Votre mot de passe
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="********"
                    class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none custom-focus transition-colors">
            </div>

            <!-- Confirmer mot de passe -->
            <div>
                <label for="confirm-password" class="block text-sm font-medium custom-text mb-2">
                    Confirmer votre mot de passe
                </label>
                <input
                    type="password"
                    id="confirm-password"
                    name="confirm-password"
                    placeholder="********"
                    class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none custom-focus transition-colors">
            </div>

            <!-- Boutons -->
            <div class="grid grid-cols-2 gap-4">
                <a
                    class="w-full custom-primary text-white py-3 px-6 rounded-lg font-medium hover:custom-primary transition-colors flex items-center justify-center gap-2"
                    href="/inscription/0"
                    >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Précédent
                </a>
                <button
                    type="submit"
                    class="w-full custom-primary text-white py-3 px-6 rounded-lg font-medium hover:custom-primary transition-colors">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>

    <script>
        // Fonction pour changer dynamiquement les couleurs
        function changeTheme(colors) {
            const root = document.documentElement;
            Object.keys(colors).forEach(key => {
                root.style.setProperty(`--${key}`, colors[key]);
            });
        }

        // Gestion des uploads d'images
        function setupImageUpload(side) {
            const uploadArea = document.getElementById(`${side}-upload`);
            const input = document.getElementById(`${side}-input`);
            const placeholder = document.getElementById(`${side}-placeholder`);
            const preview = document.getElementById(`${side}-preview`);

            // Click pour ouvrir le sélecteur de fichier
            uploadArea.addEventListener('click', () => {
                input.click();
            });

            // Drag & Drop
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileUpload(files[0], side);
                }
            });

            // Changement de fichier
            input.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFileUpload(e.target.files[0], side);
                }
            });
        }

        function handleFileUpload(file, side) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const placeholder = document.getElementById(`${side}-placeholder`);
                    const preview = document.getElementById(`${side}-preview`);
                    const img = preview.querySelector('img');

                    img.src = e.target.result;
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImage(side) {
            const placeholder = document.getElementById(`${side}-placeholder`);
            const preview = document.getElementById(`${side}-preview`);
            const input = document.getElementById(`${side}-input`);

            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
            input.value = '';
        }

        function goBack() {
            // Fonction pour revenir à la page précédente
            window.history.back();
        }

        // Validation du mot de passe
        function validatePasswords() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                alert('Les mots de passe ne correspondent pas');
                return false;
            }

            if (password.length < 4) {
                alert('Le mot de passe doit contenir au moins 4 caractères');
                return false;
            }

            return true;
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            setupImageUpload('recto');
            setupImageUpload('verso');
        });
    </script>
</body>

</html>