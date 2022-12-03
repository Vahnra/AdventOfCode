<?php

// Read the file and store the rucksacks in an array
$file = fopen("input.txt", "r");
$rucksacks = [];
while (!feof($file)) {
    $rucksacks[] = fgets($file);
}
fclose($file);

// Define a function to get the total sum of priorities
function getSumOfPriorities($rucksacks) {
    $totalSum = 0;
    foreach ($rucksacks as $rucksack) {
        // Skip empty lines
        if (trim($rucksack) == "") {
            continue;
        }

        // Split the rucksack into two compartments
        $compartment1 = str_split($rucksack, strlen($rucksack) / 2)[0];
        $compartment2 = str_split($rucksack, strlen($rucksack) / 2)[1];

        // Find the item type that appears in both compartments
        $commonItemType = "";
        for ($i = 0; $i < strlen($compartment1); $i++) {
            $itemType = $compartment1[$i];
            if (strpos($compartment2, $itemType) !== false) {
                $commonItemType = $itemType;
                break;
            }
        }

        // If there is no common item type, skip the rucksack
        if ($commonItemType == "") {
            continue;
        }

        // Find the priority of the common item type
        $priority = ord($commonItemType);
        if (ctype_upper($commonItemType)) {
            $priority -= 64;
        } else {
            $priority -= 96;
        }

        // Add the priority to the total sum
        $totalSum += $priority;
    }

    return $totalSum;
}

// Get the total sum of priorities
$totalSum = getSumOfPriorities($rucksacks);
echo $totalSum;
