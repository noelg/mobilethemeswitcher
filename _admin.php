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

$core->addBehavior('adminBlogPreferencesForm',array('mobileThemeSwitcherAdminBehaviours','adminBlogPreferencesForm'));
$core->addBehavior('adminBeforeBlogSettingsUpdate',array('mobileThemeSwitcherAdminBehaviours','adminBeforeBlogSettingsUpdate'));


class mobileThemeSwitcherAdminBehaviours
{
  public static function adminBlogPreferencesForm(&$core, &$settings)
  {
    $themes = array('' => '');
    foreach (new DirectoryIterator(dirname(__FILE__).'/../../themes/') as $dir)
    {
      if ($dir->isDir() && ! $dir->isDot())
      {
        $themes[$dir->getFilename()] = $dir->getFilename();
      }
    }

    echo '<fieldset><legend>Mobile Theme Switcher</legend>'.
    '<div class="two-cols"><div class="col">'.
    '<p><label>Mobile theme</label>'.
    form::combo('mobilethemeswitcher_theme', $themes, $settings->mobilethemeswitcher_theme).
    '</p></div></div></fieldset>';
  }

  public static function adminBeforeBlogSettingsUpdate(&$settings)
  {
    $settings->setNameSpace('mobilethemeswitcher');
    $settings->put('mobilethemeswitcher_theme', empty($_POST['mobilethemeswitcher_theme'])?"":$_POST['mobilethemeswitcher_theme'], 'string');
    $settings->setNameSpace('system');
  }
}
