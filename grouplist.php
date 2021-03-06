<?php
/**
 * iF.SVNAdmin
 * Copyright (c) 2010 by Manuel Freiholz
 * http://www.insanefactory.com/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2
 * of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.
 */
include("include/config.inc.php");
$appEngine->forwardInvalidModule( !$appEngine->isGroupViewActive() );
$appEngine->checkUserAuthentication(true, ACL_MOD_GROUP, ACL_ACTION_VIEW);
$appTR->loadModule("grouplist");

// Form 'delete' request.
$delete = check_request_var('delete');
if($delete)
{
  $appEngine->handleAction('delete_group');
}

// Get all groups and sort them by name.
$groups = $appEngine->getGroupViewProvider()->getGroups();
usort( $groups, array('\svnadmin\core\entities\Group',"compare") );

SetValue("GroupList", $groups);
ProcessTemplate("group/grouplist.html.php");
?>
