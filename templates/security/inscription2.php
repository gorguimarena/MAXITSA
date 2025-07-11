<?php
$errors = $this->session->get('errors') ?? [];
$old = $this->session->get('old2')  ?? [];
var_dump($errors);
unset($_SESSION['errors'], $_SESSION['old2']);
?>

<form class="space-y-6" method="post" action="/inscription/2" enctype="multipart/form-data">
    <!-- Upload Photos Section -->
    <div>
        <label class="block text-sm font-medium custom-text mb-4">
            Veuillez charger les photos :
        </label>

        <div class="grid grid-cols-2 gap-4">
            <!-- Recto -->
            <div class="space-y-2">
                <div class="text-center <?= isset($errors['cni_recto']) ? 'border-red-500' : 'custom-focus' ?>">
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
                    <input type="file" id="recto-input"  name="cni_recto" accept="image/*" class="hidden">
                </div>
            </div>

            <!-- Verso -->
            <div class="space-y-2">
                <div class="text-center <?= isset($errors['cni_verso']) ? 'border-red-500' : 'custom-focus' ?>">
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
            value="<?= htmlspecialchars($old['password'] ?? '') ?>"
            class="w-full px-4 py-3 border <?= isset($errors['password']) ? 'border-red-500' : 'custom-focus' ?> custom-border rounded-lg focus:outline-none  transition-colors">
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
            value="<?= htmlspecialchars($old['confirm-password'] ?? '') ?>"
            class="w-full px-4 py-3 border custom-border <?= isset($errors['confirm-password']) ? 'border-red-500' : 'custom-focus' ?> rounded-lg focus:outline-none transition-colors">
    </div>

    <!-- Boutons -->
    <div class="grid grid-cols-2 gap-4">
        <a
            class="w-full custom-primary text-white py-3 px-6 rounded-lg font-medium hover:custom-primary transition-colors flex items-center justify-center gap-2"
            href="/inscription/0">
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
<script>
    function changeTheme(colors) {
        const root = document.documentElement;
        Object.keys(colors).forEach(key => {
            root.style.setProperty(`--${key}`, colors[key]);
        });
    }

    function setupImageUpload(side) {
        const uploadArea = document.getElementById(`${side}-upload`);
        const input = document.getElementById(`${side}-input`);
        const placeholder = document.getElementById(`${side}-placeholder`);
        const preview = document.getElementById(`${side}-preview`);

        uploadArea.addEventListener('click', () => {
            input.click();
        });

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
        window.history.back();
    }

    document.addEventListener('DOMContentLoaded', () => {
        setupImageUpload('recto');
        setupImageUpload('verso');
    });
</script>