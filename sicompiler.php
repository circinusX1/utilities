#!/usr/bin/php
<?php
	if(count($argv)==1)
	{
		echo "pass the CPP/C file";
		exit;
	}
	$filec=$argv[1];
	$incs="";

	system("[[ ! -d FAKE ]] && mkdir -p FAKE ");
	system("[[ -d FAKE ]] && rm FAKE/* ");

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
			echo "\nFound Results in curent folder '".$o2."'";
			if(strlen($o2)==0)
			{
  			    $uo2=shell_exec("find /usr/include -name {$file}");
				echo "\nFound Results in curent /usr/include '".$uo2."'";

				if(strlen($uo2) <2)
				{
					system("touch FAKE/{$file}");
					$incs .= "-IFAKE/{$file} ";
					continue;
				}
                $o2=$uo2;
			}
			echo "Adding includes for {$o2}";
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
