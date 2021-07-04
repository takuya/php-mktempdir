<?php


if( !function_exists('mktempdir') ){
  
  /**
   * @param string $prefix prefix for tmpdir, 'myname' results in '/tmp/myname-XXXX'.
   * @param string $keep_directory_after_finished stop auto remove tmpdir by register_shutdown_function, Default is auto remove(false).
   * @return string path to tmpdir.
   */
  
  function mktempdir( $prefix=null, $keep_directory_after_finished=false):string{
    
    $prefix  = $prefix ?? 'php-tempdir';
    $temp_name = tempnam(sys_get_temp_dir(), $prefix.'-');
    unlink($temp_name);
    $dir = $temp_name;
    mkdir($dir);
    // 消さなくても自動的に削除されるように。
    if ( !$keep_directory_after_finished ){
      register_shutdown_function(function() use ($dir) {
        if ( is_dir($dir)){
          rrmdir($dir);
        }
      });
    }
    return $dir;
  }
}

