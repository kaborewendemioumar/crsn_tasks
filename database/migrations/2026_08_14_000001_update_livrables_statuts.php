<?php 
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Support\Facades\DB; 
return new class extends Migration { 
public function up(): void { 
if (DB::getDriverName() === 'mysql') { 
DB::statement(" ALTER TABLE livrables MODIFY COLUMN statut ENUM('Soumis', 'Validé', 'Rejeté', 'En correction') DEFAULT 'Soumis' "); 
  } 
elseif (DB::getDriverName() === 'pgsql') { 
DB::statement(" ALTER TABLE livrables ALTER COLUMN statut TYPE VARCHAR(255) USING statut::text "); DB::statement(" ALTER TABLE livrables ALTER COLUMN statut SET DEFAULT 'Soumis' "); 
} 
} 
public function down(): void { 
if (DB::getDriverName() === 'mysql') { 
DB::statement(" ALTER TABLE livrables MODIFY COLUMN statut ENUM('Soumis', 'Validé', 'Rejeté') DEFAULT 'Soumis' "); 
  } 
elseif (DB::getDriverName() === 'pgsql') { 
DB::statement(" ALTER TABLE livrables ALTER COLUMN statut TYPE VARCHAR(255) USING statut::text "); DB::statement(" ALTER TABLE livrables ALTER COLUMN statut SET DEFAULT 'Soumis' "); 
  } 
} 
};