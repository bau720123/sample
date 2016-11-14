<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2012 Coppermine Dev Team
  v1.0 originally written by Gregory Demar

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.20
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/logs/log_header.inc.php $
  $Revision: 8359 $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

?>六月 05, 2012 at 09:44 AM - While executing query 'SELECT title, category, keyword FROM cpg15x_albums  WHERE aid = '42'' in editpics.php on line 103 the following error was encountered: 
Unknown column 'keyword' in 'field list'
---
六月 05, 2012 at 09:52 AM - While executing query 'SELECT aid, title FROM cpg15x_albums WHERE category = 0 ORDER BY pos ASC' in albmgr.php on line 151 the following error was encountered: 
Unknown column 'pos' in 'order clause'
---
六月 05, 2012 at 09:52 AM - While executing query 'SELECT aid, title, category FROM cpg15x_albums ORDER BY pos' in include\functions.inc.php on line 5948 the following error was encountered: 
Unknown column 'pos' in 'order clause'
---
六月 05, 2012 at 09:53 AM - While executing query 'SELECT title, comments, votes, category, aid FROM cpg15x_albums WHERE aid='1' LIMIT 1' in displayimage.php on line 419 the following error was encountered: 
Unknown column 'comments' in 'field list'
---
2012-06-05 11:12:49 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:18:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:18:22 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:18:23 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:18:27 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:18:34 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:18:49 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:19:01 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:19:26 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:20:58 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:20:59 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:20:59 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:21:00 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:21:01 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:21:37 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:22:23 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:23:29 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:24:10 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:26:15 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:26:55 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:17 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:34:29 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:36:06 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:36:13 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:40:32 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:41:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:41:53 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:47:17 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:49:50 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:50:50 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:51:50 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 11:52:45 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 12:31:00 - Unable to connect to database: No database selected
---
2012-06-05 12:41:09 - Unable to connect to database: No database selected
---
2012-06-05 12:41:50 - Unable to connect to database: No database selected
---
2012-06-05 14:06:33 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 15:57:04 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 16:03:42 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:04:00 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:04:12 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:08:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:10:27 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:10:57 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:12:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:13:01 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:13:07 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:13:45 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:14:46 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:15:13 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:16:37 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:17:23 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:19:47 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:22:20 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:30:38 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:34:32 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:34:41 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 17:39:32 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:02:54 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:03:10 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:16:41 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:17:26 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:21:57 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:30:42 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-05 18:31:26 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-06 06:06:07 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-06 06:07:40 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 10:52:06 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 11:01:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:25:21 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:27:01 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:28:37 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:33:08 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:36:12 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:37:37 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 12:41:57 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:07:26 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:08:15 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:10:56 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:11:53 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:13:40 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:19:39 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:26:47 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:29:01 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:35:02 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:36:14 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:36:21 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:36:45 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:37:35 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:40:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:41:10 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:41:58 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:47:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:48:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:48:58 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 13:57:13 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 14:13:11 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 15:02:55 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-11 15:05:05 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 10:48:26 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 10:50:03 - Unable to connect to database: No database selected
---
2012-06-12 10:50:11 - Unable to connect to database: No database selected
---
2012-06-12 10:50:12 - Unable to connect to database: No database selected
---
2012-06-12 10:50:12 - Unable to connect to database: No database selected
---
2012-06-12 10:50:12 - Unable to connect to database: No database selected
---
2012-06-12 10:50:13 - Unable to connect to database: No database selected
---
2012-06-12 10:50:13 - Unable to connect to database: No database selected
---
2012-06-12 10:50:14 - Unable to connect to database: No database selected
---
2012-06-12 10:50:36 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 10:51:02 - Unable to connect to database: No database selected
---
2012-06-12 10:51:18 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 10:51:35 - Unable to connect to database: Access denied for user 'ODBC'@'localhost' (using password: YES)
---
2012-06-12 10:51:54 - Unable to connect to database: Access denied for user '$username_connec'@'localhost' (using password: YES)
---
2012-06-12 10:52:26 - Unable to connect to database: Unknown MySQL server host '$hostname_connection' (11004)
---
2012-06-12 10:52:44 - Unable to connect to database: Access denied for user '$username_connec'@'localhost' (using password: YES)
---
2012-06-12 10:53:04 - Unable to connect to database: Access denied for user '$username_connec'@'localhost' (using password: YES)
---
2012-06-12 10:53:10 - Unable to connect to database: Access denied for user '$username_connec'@'localhost' (using password: YES)
---
2012-06-12 10:53:40 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 10:54:06 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 10:54:45 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:00:45 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:01:39 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:02:03 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:02:23 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:02:58 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:04:56 - Unable to connect to database: Access denied for user 'ODBC'@'localhost' (using password: YES)
---
2012-06-12 11:05:09 - Unable to connect to database: Access denied for user '$username_bau'@'localhost' (using password: YES)
---
2012-06-12 11:05:26 - Unable to connect to database: 
---
2012-06-12 11:05:55 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:12:25 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:14:00 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:14:23 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:15:14 - While executing query 'SELECT u.user_id AS id, u.user_name AS username, user_password AS password, u.user_group AS group_id FROM ``.cpg15x_users AS u LEFT JOIN ``.cpg15x_usergroups AS g ON u.user_group=g.group_id WHERE u.user_id='1'' in bridge\udb_base.inc.php on line 70 the following error was encountered: 
Incorrect database name ''
---
2012-06-12 11:15:31 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:16:38 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:17:56 - While executing query 'SELECT session_id FROM ``.cpg15x_sessions WHERE session_id = '8fd29d24048e830b851fa55aa3bf6205'' in bridge\coppermine.inc.php on line 371 the following error was encountered: 
Incorrect database name ''
---
2012-06-12 11:18:53 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:19:19 - Unable to connect to database: Access denied for user 'root'@'localhost' (using password: NO)
---
2012-06-12 11:19:40 - Unable to connect to database: Access denied for user 'root'@'localhost' (using password: NO)
---
2012-06-12 11:20:43 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:20:58 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:22:03 - While executing query 'DELETE FROM ``.sessions WHERE time < 1339496523 AND remember = 0' in bridge\coppermine.inc.php on line 255 the following error was encountered: 
Incorrect database name ''
---
2012-06-12 11:22:14 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:23:10 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:23:29 - While executing query 'SELECT user_id, time FROM `sample1`.cpg15x_sessions WHERE session_id = '5798cf132dd653d33fe1e479d75c791c'' in bridge\coppermine.inc.php on line 271 the following error was encountered: 
Table 'sample1.cpg15x_sessions' doesn't exist
---
2012-06-12 11:23:48 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:24:07 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:24:13 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:24:34 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 11:24:43 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 17:55:49 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 17:57:04 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 17:57:06 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:07:43 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:11:52 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:13:40 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:13:54 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:30:44 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:31:08 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:31:13 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 18:43:23 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 19:00:32 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-12 19:01:15 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-13 03:48:43 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-13 03:51:24 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-13 03:56:35 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 03:31:42 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 03:55:38 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:14:33 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:18:53 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:19:35 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:22:02 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:23:56 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:27:04 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:28:08 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:42:22 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:43:09 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 05:54:47 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-15 06:01:15 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-19 07:58:09 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-19 08:07:10 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-19 14:21:51 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-27 13:45:38 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-27 15:12:24 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-28 14:15:10 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-28 14:15:43 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-06-28 14:22:15 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-11-21 02:08:36 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-11-21 02:12:51 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-11-21 02:14:30 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2012-11-21 02:39:47 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include\init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-02 09:45:09 - Unable to connect to database: Access denied for user 'root'@'localhost' (using password: YES)
---
2013-06-02 09:47:54 - Unable to connect to database: Access denied for user 'root'@'localhost' (using password: YES)
---
2013-06-02 09:55:31 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-02 10:02:19 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-02 10:16:46 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 16:50:36 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 16:53:04 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 17:34:56 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 17:39:59 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 17:47:25 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 17:49:05 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-06-05 17:50:35 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-08-22 07:43:08 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
2013-08-22 07:43:59 - While executing query 'SELECT aid FROM cpg15x_albums WHERE moderator_group IN (3)' in include/init.inc.php on line 269 the following error was encountered: 
Unknown column 'moderator_group' in 'where clause'
---
