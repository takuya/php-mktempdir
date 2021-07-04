<?php

namespace Tests\Units;

use Tests\TestCase;

class MakeTempDirectoryTest extends TestCase {
  
  public function testMakeTempDirectory() {
    
    $path = mktempdir('tests');
    $this->assertStringContainsString('/tests-', $path);
    $this->assertStringContainsString(sys_get_temp_dir(), $path);
    $this->assertTrue(is_dir($path));
  }
  
  public function testTempDirectoryAutoRemoved() {
    // generate source code
    // and  test register_shutdown_function.
    $func_declared_files = [];
    $func_declared_files[] = (new \ReflectionFunction('mktempdir'))->getFileName();
    $func_declared_files[] = (new \ReflectionFunction('rrmdir'))->getFileName();
    $str = "<?php
      require_once '{$func_declared_files[0]}';
      require_once '{$func_declared_files[1]}';
      \$path = mktempdir('tests');
      echo \$path;
    ";
    $str = join(PHP_EOL, array_map('trim', preg_split('/\n/', $str)));
    $tmp_fp = tmpfile();
    $path = stream_get_meta_data($tmp_fp)['uri'];
    fwrite($tmp_fp, $str);
    $tmp_path = system("php '${path}'");
    //
    
    $ret = is_dir($tmp_path);
    $this->assertFalse($ret);
    
    
  }
}