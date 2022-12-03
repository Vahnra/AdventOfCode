<?php
// Read in the input from the file
$food_calories = array();
$current_elf = 0;
$lines = file("input.txt");
foreach ($lines as $line) {
    // Remove leading and trailing whitespace from the line
    $line = trim($line);

    // If the line is empty, move on to the next Elf
    if ($line == "") {
        // Start a new list for the next Elf's food
        $current_elf++;
        $food_calories[$current_elf] = array();
    } else {
        // Otherwise, add the Calories to the current Elf's list
        $food_calories[$current_elf][] = (int)$line;
    }
}

// Find the Elf with the most Calories
$max_calories = 0;
$max_elf = 0;
foreach ($food_calories as $i => $elf) {
    // Calculate the total number of Calories for this Elf
    $total_calories = array_sum($elf);

    // If this Elf has more Calories than the current max, update the max
    if ($total_calories > $max_calories) {
        $max_calories = $total_calories;
        $max_elf = $i;
    }
}

// Print the result
echo "Elf $max_elf is carrying the most Calories, with a total of $max_calories Calories\n";

// Sort the Elves by the total number of Calories they are carrying
usort($food_calories, function($a, $b) {
  return array_sum($b) - array_sum($a);
});

// Take the first three Elves in the sorted list
$top_calories = array_slice($food_calories, 0, 3);

// Calculate the total number of Calories carried by the top three Elves
$total_calories = array_sum(array_map("array_sum", $top_calories));

// Print the result
echo "The top three Elves are carrying a total of $total_calories Calories\n";