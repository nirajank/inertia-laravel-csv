<?php

namespace App\Repositories;

use App\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ClientCsvRepository implements ClientRepositoryInterface
{
    private $csvFilePath;

    public function __construct()
    {
        $this->csvFilePath = env('CSV_FILE_PATH');
    }


    private function readCsvData(): array
    {
        if (!Storage::exists($this->csvFilePath)) {
            return [];
        }

        $content = Storage::get($this->csvFilePath);
        $lines = explode("\n", $content);

        if (empty($lines)) {
            return [];
        }

        $headers = str_getcsv(array_shift($lines)); // Extract header row
        $data = [];
        $index = 1; // Initialize index variable

        foreach ($lines as $line) {
            $row = str_getcsv($line);
            if (count($row) === count($headers)) {
                $rowData = array_combine($headers, $row);
                $rowData['id'] = $index; // Add id property with array value index
                $data[] = $rowData;
                $index++; // Increment index for the next row
            }
        }

        return $data;
    }

    private function writeCsvData(array $data): void
    {
        $csvContent = "";
        $isFirstRow = true;
        foreach ($data as $row) {
            if ($isFirstRow) {
                $csvContent .= implode(",", [
                    'id',
                    'name',
                    'email',
                    'phone',
                    'address',
                    'nationality',
                    'background'
                ]) . "\n";
                $isFirstRow = false;
            }
            //row and header should be the same order for csv store so it is is mandatory to map each row
            $row = [
                $row['id'],
                $row['name'],
                $row['email'],
                $row['phone'],
                $row['address'],
                $row['nationality'],
                $row['background']
            ];
            $csvContent .= implode(",", $row) . "\n";
        }

        Storage::put($this->csvFilePath, trim($csvContent));
    }

    public function all(): array
    {
        return $this->readCsvData();
    }

    public function find(int $id): ?array
    {
        $clients = $this->readCsvData();
        foreach ($clients as $client) {
            if ($client[0] === $id . '') { // Convert ID to string for comparison
                return $client;
            }
        }
        return null;
    }

    public function create(array $data): void
    {
        $clients = $this->readCsvData();
        $data['id'] = empty($clients) ? 1 : count($clients) + 1;
        $clients[] = $data;
        $this->writeCsvData($clients);
    }

    public function update(int $id, array $data): bool
    {
        $clients = $this->readCsvData();
        $updated = false;
        $newClients = [];
        foreach ($clients as $client) {
            if ($client['id'] === $id) { // Convert ID to string for comparison
                $newClients[] = $data;
                $updated = true;
            } else {
                $newClients[] = $client;
            }
        }
        if ($updated) {
            $this->writeCsvData($newClients);
        }
        return $updated;
    }

    public function delete(int $id): bool
    {
        $clients = $this->readCsvData();
        $newClients = [];
        $deleted = false;
        foreach ($clients as $client) {
            if ($client['id'] != $id) { // Convert ID to string for comparison
                $newClients[] = $client;
            } else {
                $deleted = true;
            }
        }
        if ($deleted) {
            $this->writeCsvData($newClients);
        }
        return $deleted;
    }
}
