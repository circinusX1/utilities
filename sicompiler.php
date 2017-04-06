#!/usr/bin/php
<?php

	if(count($argv)==1)
	{
		echo "pass the CPP/C file";
		exit;
	}
	$filec=$argv[1];
	$incs="";
	while(1)
	{
		$cmd = "gcc {$incs} -DCPU_BE -E {$filec} -o {$filec}.out 2>&1";
		echo "\n".$cmd ."\n";
		$o = shell_exec($cmd);
		echo $o;
		$posS = strpos($o, "error:");
		$posE = strpos($o, ": No such");

		if($posS>1 && $posE>1)
		{
			$file = substr($o, $posS+7, $posE-$posS-7);
			echo "\nfind -name {$file}\n";
			$o2=shell_exec("find -name {$file}");
			echo $o2."\n";
			if(strlen($o2)==0)
			{
  			    $o2=shell_exec("find /usr/include -name {$file}");
				if(strlen($o2==0))
				{
					system("touch FAKE/{$file}");
					$incs .= "-IFAKE/{$ifile} ";
					continue;
				}
			}
			$ao2 = explode("\n",$o2);
			if(count($ao2))	
			{
				$ifile = dirname($ao2[0]);
				$incs .= "-I{$ifile} ";
				continue;
			}
			else
			{
				$ifile = dirname($o2);
                   $incs .= "-I{$ifile} ";
			}
			continue;
		}
		break;
	}

?>
