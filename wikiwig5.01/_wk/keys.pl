#! /usr/bin/perl
@files = @ARGV;
$expected = $#ARGV + 1;
for ($i = 0; $i < $expected; $i++) {
    $curfile = $files[$i];
    # print "opening ", $curfile, "\n";
    open F, $curfile;
    while (<F>) {
	$line = $_;
	chomp($line);
	# print $line, "\n";
	($define, $rest) = split(",", $line);
	if ($define =~ "define") {
	    $define =~ s/\@define\('//;
	    $define =~ s/'.*//;
	    if (exists($counts{$define})) {
		$counts{$define}++;
	    } else {
		$counts{$define} = 1;
	    }
	    $messages{$curfile}{$define} = $line;
	    $accum = ($line =~ /\);/);

	} elsif ($accum) {
	    $messages{$curfile}{$define} .= $line;
	    # $messages{$curfile}{$define} =. $line;
	    $accum = ($line =~ /\);/);
	}
    }
}
foreach $key (sort keys %counts) {
    print $key, "\n";
}

