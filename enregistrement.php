<?php
// enregistrement.php - Version complète avec photo

$host = 'localhost';
$db   = 'identite-db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . htmlspecialchars($e->getMessage()));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données texte
    $numero_cni     = strtoupper(trim($_POST['numero_cni'] ?? ''));
    $izina          = strtoupper(trim($_POST['izina'] ?? ''));
    $amatazirano    = trim($_POST['amatazirano'] ?? '');
    $sexe           = $_POST['sexe'] ?? '';
    $se             = strtoupper(trim($_POST['se'] ?? ''));
    $nyina          = strtoupper(trim($_POST['nyina'] ?? ''));
    $province       = trim($_POST['province'] ?? '');
    $komine         = trim($_POST['komine'] ?? '');
    $yavukiye       = trim($_POST['yavukiye'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $arubatse       = $_POST['arubatse'] ?? '';
    $akazi_akora    = trim($_POST['akazi_akora'] ?? '');
    $adresse        = trim($_POST['adresse'] ?? '');

    $photo_data = null;

    // Gestion de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $file = $_FILES['photo'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        
        if (!in_array($file['type'], $allowed_types)) {
            die("Erreur : Seules les images JPG et PNG sont autorisées.");
        }
        if ($file['size'] > 2 * 1024 * 1024) {
            die("Erreur : La photo ne doit pas dépasser 2 Mo.");
        }

        $photo_data = file_get_contents($file['tmp_name']);
    } else {
        die("Erreur : La photo est obligatoire.");
    }

    // Validation des champs obligatoires
    if (empty($numero_cni) || empty($izina) || empty($amatazirano) || empty($sexe) || 
        empty($se) || empty($nyina) || empty($date_naissance)) {
        die("Erreur : Tous les champs obligatoires doivent être remplis.");
    }

    try {
        // Vérifier si CNI existe déjà
        $stmt = $pdo->prepare("SELECT id FROM citoyens WHERE numero_cni = ?");
        $stmt->execute([$numero_cni]);
        if ($stmt->rowCount() > 0) {
            die("Erreur : Ce numéro de CNI est déjà enregistré.");
        }

        // Insertion avec photo
        $sql = "INSERT INTO citoyens (
                    numero_cni, izina, amatazirano, sexe, se, nyina, province, komine, 
                    yavukiye, date_naissance, arubatse, akazi_akora, adresse, photo
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $numero_cni, $izina, $amatazirano, $sexe, $se, $nyina, $province, $komine,
            $yavukiye, $date_naissance, $arubatse, $akazi_akora, $adresse, $photo_data
        ]);

        echo "<h1 style='color:green; text-align:center; margin-top:50px;'>✅ Enregistrement réussi avec photo !</h1>";
        echo "<p style='text-align:center;'><a href='identite.html' style='color:#006400; font-size:1.2em;'>Nouvelle saisie</a></p>";

    } catch(PDOException $e) {
        die("Erreur d'enregistrement : " . htmlspecialchars($e->getMessage()));
    }

} else {
    header("Location: identite.html");
    exit();
}
?>