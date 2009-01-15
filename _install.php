<?php

/*
Copyright (c) 2008 Noel GUILBERT

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

if (!defined('DC_CONTEXT_ADMIN')) { return; }
 
# On lit la version du plugin
$m_version = $core->plugins->moduleInfo('mobileThemeSwitcher','version');
 
# On lit la version du plugin dans la table des versions
$i_version = $core->getVersion('mobileThemeSwitcher');
 
# La version dans la table est supérieure ou égale à
# celle du module, on ne fait rien puisque celui-ci
# est installé
if (version_compare($i_version,$m_version,'>=')) {
  return;
}

# Création du setting (s'il existe, il ne sera pas écrasé)
$settings = new dcSettings($core,null);
$settings->setNamespace('mobileThemeSwitcher');
$settings->put('mobileThemeSwitcher_theme', null, 'string', 'mobileThemeSwitcher theme', false, true);

 
# La procédure d'installation commence vraiment là
$core->setVersion('mobileThemeSwitcher',$m_version);

