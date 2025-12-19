<?php
/**
 * Vue pour afficher les détails des livraisons d'un véhicule
 * Affiche un tableau avec: date, chiffre d'affaire, coût de revient, bénéfice
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails des Livraisons - <?php echo htmlspecialchars($marque ?? 'Véhicule'); ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/form.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #4CAF50;
        }
        
        h1 {
            color: #333;
            margin: 0;
        }
        
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn-back:hover {
            background-color: #0b7dda;
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
        
        .currency {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        
        .date-cell {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .total-row {
            background-color: #ecf0f1;
            font-weight: bold;
        }
        
        .total-row td {
            border-top: 2px solid #bdc3c7;
            border-bottom: 2px solid #bdc3c7;
        }
        
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .stats-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #7f8c8d;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .stat-card .value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 Détails des livraisons - <?php echo htmlspecialchars($marque ?? 'Véhicule'); ?></h1>
            <a href="/benefices_vehicules" class="btn-back">← Retour aux bénéfices</a>
        </div>

        <?php if (!empty($details)): ?>
            <!-- Statistiques résumées -->
            <div class="stats-box">
                <div class="stat-card">
                    <h3>Nombre de Livraisons</h3>
                    <div class="value" style="color: #9b59b6;">
                        <?php echo count($details); ?>
                    </div>
                </div>
            </div>
        
            <!-- Tableau des détails -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date de Livraison</th>
                            <th class="currency">Chiffre d'Affaire (Ar)</th>
                            <th class="currency">Coût de Revient (Ar)</th>
                            <th class="currency">Bénéfice (Ar)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalChiffre = 0;
                        $totalRevientSum = 0;
                        $totalBeneficeSum = 0;
                        
                        foreach ($details as $livraison) {
                            $totalChiffre += $livraison['chiffre_affaire'];
                            $totalRevientSum += $livraison['revient'];
                            $totalBeneficeSum += $livraison['benefice'];
                            
                            $beneficeClass = $livraison['benefice'] >= 0 ? 'positive' : 'negative';
                            $dateFormatted = date('d/m/Y H:i', strtotime($livraison['date_livraison']));
                            
                            echo '<tr>';
                            echo '<td class="date-cell">' . $dateFormatted . '</td>';
                            echo '<td class="currency">' . number_format($livraison['chiffre_affaire'], 0, ',', ' ') . '</td>';
                            echo '<td class="currency">' . number_format($livraison['revient'], 0, ',', ' ') . '</td>';
                            echo '<td class="currency ' . $beneficeClass . '">' . number_format($livraison['benefice'], 0, ',', ' ') . '</td>';
                            echo '</tr>';
                        }
                        
                        // Ligne de totaux
                        $totalClass = $totalBeneficeSum >= 0 ? 'positive' : 'negative';
                        echo '<tr class="total-row">';
                        echo '<td>TOTAL</td>';
                        echo '<td class="currency">' . number_format($totalChiffre, 0, ',', ' ') . '</td>';
                        echo '<td class="currency">' . number_format($totalRevientSum, 0, ',', ' ') . '</td>';
                        echo '<td class="currency ' . $totalClass . '">' . number_format($totalBeneficeSum, 0, ',', ' ') . '</td>';
                        echo '</tr>';
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Totaux résumés en bas -->
            <div class="stats-box" style="margin-top: 30px;">
                <div class="stat-card">
                    <h3>Total Chiffre d'Affaire</h3>
                    <div class="value" style="color: #3498db;">
                        <?php echo number_format($totalChiffre, 0, ',', ' '); ?> Ar
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Coût de Revient</h3>
                    <div class="value" style="color: #e74c3c;">
                        <?php echo number_format($totalRevientSum, 0, ',', ' '); ?> Ar
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Bénéfice</h3>
                    <div class="value" style="color: <?php echo $totalBeneficeSum >= 0 ? '#27ae60' : '#e74c3c'; ?>;">
                        <?php echo number_format($totalBeneficeSum, 0, ',', ' '); ?> Ar
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-message">
                ℹ️ Aucune livraison trouvée pour ce véhicule
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
