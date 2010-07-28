<?php

error_reporting(E_ALL);

/**
 * Script for migrating Launchpad translations into Jisko format.
 * by Marcos García <marcosgdf@gmail.com>
 *
 * Last update: 2010-07-28
 *
 * @author Marcos García <marcosgdf@gmail.com>
 */

/**
 * Directory where .PO files are. WITH A TRAILING SLASH (/)
 **/
define('PO_FILES', '/opt/lampp/htdocs/traducciones/po/');

/**
 * Directory where .MO files are. WITH A TRAILING SLASH (/)
 */
define('MO_FILES', '/opt/lampp/htdocs/traducciones/mo/');

/**
 * Directory where the final result will be. WITH A TRAILING SLASH (/)
 */
define('DEST_DIR', '/opt/lampp/htdocs/traducciones/final/');

echo '<h1>PO FILES</h1>';

if (is_dir(PO_FILES))
{
	if ($dirfd = opendir(PO_FILES))
	{
		while (($file = readdir($dirfd)) !== false)
		{
			if ($file != '..' && ($file != '.' && ($file != 'jisko.pot')))
			{
				$language = str_replace('jisko-', '', str_replace('.po', '', $file));
				
				if (!is_dir(DEST_DIR.$language))
				{
					mkdir(DEST_DIR.$language);
				}
				
				echo 'Copy '.$file.' to '.DEST_DIR.$language.'/messages.po - ....<br /><br />';
				copy(PO_FILES.$file, DEST_DIR.$language.'/messages.po');
			}
		}
	}
}

echo '<h1>MO FILES</h1>';

if (is_dir(MO_FILES))
{
	if ($dirfd = opendir(MO_FILES))
	{
		while (($file = readdir($dirfd)) !== false)
		{
			if ($file != '..' && ($file != '.'))
			{
				if (is_dir(MO_FILES.$file))
				{
					if ($file != 'templates')
					{
						$language = $file;
					
						if (!is_dir(DEST_DIR.$language))
						{
							mkdir(DEST_DIR.$language);
						}
					
						mkdir(DEST_DIR.$language.'/LC_MESSAGES');
					
						echo 'Copy '.$file.'.mo to '.DEST_DIR.$language.'/LC_MESSAGES/messages.mo - ....<br /><br />';
						copy(MO_FILES.$file.'/LC_MESSAGES/jisko.mo', DEST_DIR.$language.'/LC_MESSAGES/messages.mo');
					}
				}
			}
		}
	}
}


?>