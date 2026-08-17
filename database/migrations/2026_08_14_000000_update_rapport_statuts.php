<?php 
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Support\Facades\DB; 
return new class extends Migration { 
public function up(): void { 
if (DB::getDriverName() === 'mysql') { 
DB::statement(" ALTER TABLE rapports MODIFY COLUMN statut ENUM('Brouillon', 'Soumis', 'Validé', 'Rejeté', 'En correction') DEFAULT 'Brouillon' "); 
} 
elseif (DB::getDriverName() === 'pgsql') { 
DB::statement(" ALTER TABLE rapports ALTER COLUMN statut TYPE VARCHAR(255) USING statut::text "); DB::statement(" ALTER TABLE rapports ALTER COLUMN statut SET DEFAULT 'Brouillon' ");
 } 
} 
public function down(): void { 
if (DB::getDriverName() === 'mysql') { 
DB::statement(" ALTER TABLE rapports MODIFY COLUMN statut ENUM('Soumis', 'Validé', 'Rejeté') DEFAULT 'Soumis' "); 
} 
elseif (DB::getDriverName() === 'pgsql') { 
DB::statement(" ALTER TABLE rapports ALTER COLUMN statut TYPE VARCHAR(255) USING statut::text "); DB::statement(" ALTER TABLE rapports ALTER COLUMN statut SET DEFAULT 'Soumis' "); 
} 
} 
};
