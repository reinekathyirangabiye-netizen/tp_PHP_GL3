<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification & Enregistrement CNI - Burundi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .photo-preview {
            margin-top: 15px;
            text-align: center;
        }
        .photo-preview img {
            max-width: 200px;
            max-height: 250px;
            border: 3px solid #006400;
            border-radius: 10px;
            object-fit: cover;
        }
        .upload-area {
            border: 2px dashed #006400;
            padding: 20px;
            border-radius: 10px;
            background: #f8fff8;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🇧🇮 Enregistrement CNI - Burundi</h1>
        <p>Service de saisie des données de la Carte Nationale d'Identité</p>

        <form action="enregistrement.php" method="POST" enctype="multipart/form-data" id="formIdentite">
            
            <!-- Photo -->
            <div class="form-group">
                <label for="photo">Photo d'identité (format passeport) :</label>
                <div class="upload-area" onclick="document.getElementById('photo').click()">
                    <input type="file" id="photo" name="photo" accept="image/*" style="display:none;" required>
                    <p>Cliquez ici pour télécharger la photo<br><small>(JPG, PNG - max 2MB)</small></p>
                </div>
                <div class="photo-preview" id="preview">
                    <!-- La photo apparaîtra ici -->
                </div>
            </div>

            <!-- Autres champs (identiques à la version précédente) -->
            <div class="form-group">
                <label for="numero_cni">N° CNI :</label>
                <input type="text" id="numero_cni" name="numero_cni" placeholder="Ex: MFP531.0606/200.217/2018" required>
            </div>

            <div class="form-group">
                <label for="izina">Izina (Nom) :</label>
                <input type="text" id="izina" name="izina" required>
            </div>

            <div class="form-group">
                <label for="amatazirano">Amatazirano (Prénoms) :</label>
                <input type="text" id="amatazirano" name="amatazirano" required>
            </div>

            <div class="form-group">
                <label for="sexe">Sexe :</label>
                <select id="sexe" name="sexe" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Gabo">Gabo (Masculin)</option>
                    <option value="Gore">Gore (Féminin)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="se">Se (Nom du père) :</label>
                <input type="text" id="se" name="se" required>
            </div>

            <div class="form-group">
                <label for="nyina">Nyina (Nom de la mère) :</label>
                <input type="text" id="nyina" name="nyina" required>
            </div>

            <div class="form-group">
                <label for="province">Province :</label>
                <input type="text" id="province" name="province" placeholder="Ex: GITEGA">
            </div>

            <div class="form-group">
                <label for="komine">Komine :</label>
                <input type="text" id="komine" name="komine" placeholder="Ex: GISHUBI">
            </div>

            <div class="form-group">
                <label for="yavukiye">Yavukiye (Lieu de naissance) :</label>
                <input type="text" id="yavukiye" name="yavukiye" placeholder="Ex: NYAKANAZI" required>
            </div>

            <div class="form-group">
                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" required>
            </div>

            <div class="form-group">
                <label for="arubatse">Arubatse (État civil) :</label>
                <select id="arubatse" name="arubatse">
                    <option value="">-- Sélectionner --</option>
                    <option value="Ntarubaka">Ntarubaka (Célibataire)</option>
                    <option value="Arubatse">Arubatse (Marié(e))</option>
                    <option value="Uwapfakaye">Uwapfakaye (Veuf/ve)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="akazi_akora">Akazi akora (Profession) :</label>
                <input type="text" id="akazi_akora" name="akazi_akora" placeholder="Ex: Umuhinga, Umwigisha...">
            </div>

            <div class="form-group">
                <label for="adresse">Adresse actuelle :</label>
                <input type="text" id="adresse" name="adresse">
            </div>

            <button type="submit" class="btn">Enregistrer dans la Base de Données</button>
        </form>
    </div>

    <script>
        // Prévisualisation de la photo avec JavaScript
        document.getElementById('photo').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            const file = e.target.files[0];
            if (!file) return;

            // Vérification taille (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert("La photo est trop volumineuse ! Maximum 2 Mo.");
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>