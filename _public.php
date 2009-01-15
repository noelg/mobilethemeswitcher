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

$core->addBehavior('publicPrepend',array('mobileThemeSwitcherBehaviors','changeTheme'));
$core->tpl->addValue('FullVersion', array('tplMobileThemeSwitcher', 'linkToFullVersion'));
$core->tpl->addValue('MobileVersion', array('tplMobileThemeSwitcher', 'linkToMobileVersion'));

class mobileThemeSwitcherBehaviors
{ 
  public static function changeTheme (&$core)
  {
    global $__theme;
    $theme = null;
    $cookieName = 'dc_standard_theme_'.$core->blog->id;
    
    if (isset($_COOKIE[$cookieName]))
    {
      $theme = $_COOKIE[$cookieName];
    }

    if (isset($_GET['dc_standard_theme']))
    {
      $theme = $core->blog->settings->theme;
    }
    elseif (isset($_GET['dc_mobile_theme']) || (!$theme && self::isMobileDevice()))
    {
      $theme = $core->blog->settings->mobilethemeswitcher_theme;
    }

    if ($theme && $core->themes->moduleExists($theme))
    {
      setcookie($cookieName, $theme);
      $__theme = $theme;
      $core->blog->settings->theme = $__theme;
    }
  }

  protected static function isMobileDevice()
  {
    $patterns = array(
      '#Mobile/.+Safari#i', // iPhone UA
      '#Opera Mobi#i', // AT&T phone
      '#BlackBerry#i', // Blackberry
      '#Windows CE#i', // Windows CE phone: HP iPAQ, HTC, Palm
      '#Profile/MIDP-2.0#i', // Motorola
      '#Opera mini#i', // Opera mini browser
      '#Symbian#i', // Symbian OS
    );

    foreach ($patterns as $pattern)
    {
      if (preg_match($pattern, $_SERVER['HTTP_USER_AGENT']))
      {
        return true;
      }
    }

    return false;
  }
}

class tplMobileThemeSwitcher
{
  public static function linkToFullVersion($attr)
  {
    return '<a href="?dc_standard_theme=1">'.__('Full Version').'</a>';
  }

  public static function linkToMobileVersion($attr)
  {
    return '<a href="?dc_mobile_theme=1">'.__('Mobile Version').'</a>';
  }
}
