<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class CountryModel extends BaseDbModel
{
    public function getUsersByCountry($countryName): array{
        $stmt =$this->pdo ->prepare("SELECT * FROM aux_countries auc  WHERE auc.country_name LIKE ?");
        $stmt->execute([$countryName]);
        $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getCountries(): array{
        $stmt =$this->pdo ->query("SELECT DISTINCT auc.country_name FROM aux_countries auc");
        return $stmt->fetchAll();
    }
}