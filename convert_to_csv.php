<?php
// Adapted from http://webtricksandtreats.com/export-to-csv-php/
// But what if we want to use the CSV data other than just writing to a file?
function convert_to_csv($input_array, $delimiter=",", $enclosure='"')
{
    /** open raw memory as file, no need for temp files, be careful not to run out of memory thought */
    $f = fopen('php://memory', 'w');
    /** loop through array  */
    foreach ($input_array as $line) {
        /** default php csv handler **/
        fputcsv($f, $line, $delimiter, $enclosure);
    }
    /** rewrind the "file" with the csv lines **/
    fseek($f, 0);

	$csv_output = '';
    while (!feof($f)) {
		$csv_output .= fgets($f);
	}
	fclose($f);
	return $csv_output;
}

/** Array to convert to csv */

$array_to_csv = Array(
    Array(12566,
        'Enmanuel',
        'Corvo'
    ),
    Array(56544,
        'John',
        'Doe'
    ),
    Array(78550,
        'Mark',
        'Smith'
    )

);

/**
 * Outputs to:
 * 12566,Enmanuel,Corvo
 * 56544,John,Doe
 * 78550,Mark,Smith
 */
echo convert_to_csv($array_to_csv);
