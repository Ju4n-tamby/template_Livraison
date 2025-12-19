<?php
/**
 * Vue pour afficher les bénéfices par véhicule
 * Affiche un tableau avec: marque, chiffre d'affaire, revient, bénéfice
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bénéfice par Véhicule</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/form.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .table-wrapper {
            overflow-x: auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        
        thead {
            background-color: #4CAF50;
            color: white;
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        
        tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .positive {
            color: #27ae60;
            font-weight: bold;
        }
        
        .negative {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .neutral {
            color: #7f8c8d;
        }
        
        .currency {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        
        .total-row {
            background-color: #ecf0f1;
            font-weight: bold;
        }
        
        .total-row td {
            border-top: 2px solid #bdc3c7;
            border-bottom: 2px solid #bdc3c7;
        }
        
        .btn-container {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
        
        .btn-secondary {
            background-color: #2196F3;
        }
        
        .btn-secondary:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Bénéfices par Véhicule</h1>
        
        <div class="btn-container">
            <a href="/" class="btn btn-secondary">← Retour à l'accueil</a>
        </div>
        
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Marque du Véhicule</th>
                        <th class="currency">Chiffre d'Affaire (Ar)</th>
                        <th class="currency">Coût de Revient (Ar)</th>
                        <th class="currency">Bénéfice (Ar)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($benefices)) {
                        $totalChiffre = 0;
                        $totalRevient = 0;
                        $totalBenefice = 0;
                        
                        foreach ($benefices as $vehicule) {
                            $totalChiffre += $vehicule['chiffre_affaire'];
                            $totalRevient += $vehicule['revient'];
                            $totalBenefice += $vehicule['benefice'];
                            
                            $beneficeClass = $vehicule['benefice'] >= 0 ? 'positive' : 'negative';
                            
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($vehicule['marque']) . '</td>';
                            echo '<td class="currency">' . number_format($vehicule['chiffre_affaire'], 0, ',', ' ') . '</td>';
                            echo '<td class="currency">' . number_format($vehicule['revient'], 0, ',', ' ') . '</td>';
                            echo '<td class="currency ' . $beneficeClass . '">' . number_format($vehicule['benefice'], 0, ',', ' ') . '</td>';
                            echo '</tr>';
                        }
                        
                        // Ligne de totaux
                        $totalClass = $totalBenefice >= 0 ? 'positive' : 'negative';
                        echo '<tr class="total-row">';
                        echo '<td>TOTAL</td>';
                        echo '<td class="currency">' . number_format($totalChiffre, 0, ',', ' ') . '</td>';
                        echo '<td class="currency">' . number_format($totalRevient, 0, ',', ' ') . '</td>';
                        echo '<td class="currency ' . $totalClass . '">' . number_format($totalBenefice, 0, ',', ' ') . '</td>';
                        echo '</tr>';
                    } else {
                        echo '<tr><td colspan="4" style="text-align: center; padding: 20px;">Aucune donnée disponible</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
