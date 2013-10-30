#!/usr/bin/php
<?php
/**
 * @file mdimages
 * @brief Extract and manipulate images in Markdown documents.
 *
 * -i input file
 * -o output file
 * -l list images in file (-g list generated filenames)
 * -r replace image filesnames and output (or save with -o) new version
 */

$opt = getopt("i:o:lrg");

if (isset($opt["i"])) {
    if (!file_exists($opt["i"])) {
        error_log("File not found: {$opt['i']}.");
        exit(1);
    }
    $content = file_get_contents($opt["i"]);
} else {
    error_log("mdimages -i infile [-l [-g]] [-r] [-o outfile]");
    exit(1);
}

// List images
$match = null;
// Match image links (thanks Bryan!)
$_generated = isset($opt["g"]);
$s_in = [];
$s_out = [];
if (preg_match_all('/\!\[.*\]\s?\(([^\s)]*)/i',$content,$match)) {
    foreach($match[1] as $file) {
        // Output them for inclusion elsewhere
        if (fnmatch("*.png",$file)||fnmatch("*.jpg",$file)) {
            // Ignore
        } else {
            $s_in[] = $file;
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $filenew = substr($file,0,strlen($file)-strlen($ext))."png";
            $s_out[] = $filenew;
            if (isset($opt["l"])) {
                echo ($_generated?$filenew:$file)." ";
            }
        }
    }
}
if (isset($opt["l"])) echo "\n";

if (isset($opt["r"])) {
    $content = str_replace($s_in,$s_out,$content);
    if (isset($opt["o"])) {
        $outfile = $opt["o"];
        file_put_contents($outfile,$content);
    } else echo $content;
    
}
