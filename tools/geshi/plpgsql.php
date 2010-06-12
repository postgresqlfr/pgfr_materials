<?php
/*************************************************************************************
 * plpgsql.php
 * -------
 * Author: Christophe Chauvet <christophe_at_kryskool_dot_org>
 * Copyright: (c) 2007 Christophe Chauvet (http://kryskool.org/), Nigel McNie (http://qbnz.com/highlighter)
 * Release Version: 1.0.7.19
 * Date Started: 2007/07/20
 *
 * PostgreSQL PL language file for GeSHi.
 *
 * CHANGES
 * -------
 * 2007/07/20 (1.0.0)
 *	-	First Release
 *
 * TODO (updated 2007/07/20)
 * -------------------------
 *
 *************************************************************************************
 *
 *		 This file is part of GeSHi.
 *
 *	 GeSHi is free software; you can redistribute it and/or modify
 *	 it under the terms of the GNU General Public License as published by
 *	 the Free Software Foundation; either version 2 of the License, or
 *	 (at your option) any later version.
 *
 *	 GeSHi is distributed in the hope that it will be useful,
 *	 but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
 *	 GNU General Public License for more details.
 *
 *	 You should have received a copy of the GNU General Public License
 *	 along with GeSHi; if not, write to the Free Software
 *	 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA	02111-1307	USA
 *
 ************************************************************************************/

$language_data = array (
	'LANG_NAME' => 'PL/pgSQL',
	'COMMENT_SINGLE' => array(1 =>'--'), 
	'COMMENT_MULTI' => array('/*' => '*/'), 
	'CASE_KEYWORDS' => GESHI_CAPS_UPPER,
	'QUOTEMARKS' => array("'", '"'), 
	'ESCAPE_CHAR' => '\\',
	'KEYWORDS' => array(
		//PL/pgSQL reserved keywords 
        1 => array(
          // Composed Keyword
          'RAISE DEBUG',
          'RAISE LOG',
          'RAISE INFO',
          'RAISE NOTICE',
          'RAISE WARNING',
          'RAISE EXCEPTION',
          //
          'TYPE',
          'ROWTYPE',
          'AFTER',
          'ALIAS FOR',
          'ALL',
          'AND',
          'AS',
          'BEFORE',
          'BEGIN',
          'COMMIT',
          'CONSTANT',
          'CONTINUE',
          'CREATE',
          'CURSOR',
          'DECLARE',
          'DEFAULT',
          'DELETE',
          'ELSE',
          'ELSEIF',
          'ELSIF',
          'END',
          'EXCEPTION',
          'EXECUTE',
          'EXIT',
          'FETCH',
          'FOR EACH ROW',
          'FOR',
          'FROM',
          'FUNCTION',
          'GET DIAGNOSTICS',
          'GROUP BY',
          'IF',
          'IMMUTABLE',
          'IN REVERSE',
          'IN',
          'INDEX',
          'INSERT',
          'INTO',
          'LANGUAGE',
          'LOAD',
          'LOCK',
          'LOOP',
          'MOVE',
          'NOTICE',
          'NULL;',
          'ON',
          'OPEN',
          'OR',
          'ORDER BY',
          'OUT',
          'PERFORM',
          'PROCEDURE',
          'RECORD',
          'RENAME',
          'REPLACE',
          'RETURN',
          'RETURNS',
          'ROLLBACK PREPARED',
          'ROLLBACK TO SAVEPOINT',
          'ROLLBACK TO',
          'ROLLBACK',
          'SAVEPOINT',
          'SELECT',
          'SET',
          'SETOF',
          'STRICT',
          'TABLE',
          'THEN',
          'TO',
          'TRIGGER',
          'UNIQUE',
          'UNLISTEN',
          'UPDATE',
          'VACUUM',
          'VALUES',
          'WHEN',
          'WHERE',
          'WHILE NOT',
          'WHILE'
	      ),
		    //SQL functions 
        2 => array(
          'char_length',
          'position',
          'quote_ident',
          'substr',
          'substring',
          'to_char',
          'to_date',
        ),
		    //PostgreSQL contrib 
        3 => array(
          // adminpack
	        'pg_file_write', 'pg_file_rename', 'pg_file_rename', 'pg_file_unlink', 'pg_logdir_ls',
	        'pg_file_read', 'pg_file_length', 'pg_logfile_rotate',
          // DbLink
	        'dblink_connect', 'dblink_disconnect', 'dblink_open', 'dblink_fetch', 'dblink_close',
	        'dblink', 'dblink_exec', 'dblink_pkey_results', 'dblink_get_pkey', 'dblink_build_sql_insert',
	        'dblink_build_sql_delete', 'dblink_build_sql_update', 'dblink_current_query', 'dblink_send_query', 'dblink_is_busy',
	        'dblink_get_result', 'dblink_get_result', 'dblink_get_connections', 'dblink_cancel_query', 'dblink_error_message'
	      ),
		//PL/pgSQL predefined constant 
        4 => array(
          'FOUND',
          'IS NULL',        
          'NOT FOUND',
          'ROW_COUNT',
          'VOID',
          'EXCLUSIVE MODE',
          // Trigger
          'NEW',
          'OLD',
          'TG_NAME',
          'TG_WHEN',
          'TG_LEVEL',
          'TG_OP',
          'TG_RELID',
          'TG_RELNAME',
          'TG_NARGS',
          'TG_ARGV'
        ),
		//PL/pgSQL predefined exceptions
        5 => array(
          'unique_violation'
        )
		),
	'SYMBOLS' => array(
		'+', '%', "'", '.', '/', '(', ')', ':', ',', '*', '"', '=', '<', '>', '@', ';', '-', ':=', '=>', '||', '**', '<<', '>>', '/*', '*/', '..', '<>', '!=', '~=', '^=', '<=', '>='
		),
	'CASE_SENSITIVE' => array(
		GESHI_COMMENTS => false,
		1 => false,
		2 => false,
		3 => false,
		4 => false,
		5 => false
		),
	'STYLES' => array(
		'KEYWORDS' => array(
			1 => 'color: #00F;',
			2 => 'color: #000; text-transform: lowercase;',
			3 => 'color: #00F;',
			4 => 'color: #F00;',
			5 => 'color: #8B0; text-transform: lowercase;'
			),
		'COMMENTS' => array(
			1 => 'color: #080; font-style: italic;',
			'MULTI' => 'color: #080; font-style: italic;'
			),
		'ESCAPE_CHAR' => array(
			0 => 'color: #000; font-weight: bold;'
			),
		'BRACKETS' => array(
			0 => 'color: #00F;'
			),
		'STRINGS' => array(
			0 => 'color: #F00;'
			),
		'NUMBERS' => array(
			0 => 'color: #800;'
			),
		'METHODS' => array(
			0 => 'color: #0F0;'
			),
		'SYMBOLS' => array(
			0 => 'color: #00F;'
			),
		'REGEXPS' => array(
			),
		'SCRIPT' => array(
			0 => 'color: #0F0;'
			)
		),
		'URLS' => array(
			1 => '',
			2 => '',
			3 => '',
			4 => '',
			5 => ''
			),
	'OOLANG' => false,
	'OBJECT_SPLITTERS' => array(),
	'REGEXPS' => array(),
	'STRICT_MODE_APPLIES' => GESHI_NEVER,
	'SCRIPT_DELIMITERS' => array(),
	'HIGHLIGHT_STRICT_BLOCK' => array()
);

?>
