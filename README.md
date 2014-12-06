php-ignorepath
==============

This is a class for ignoring file.

Example
---

PHP Code:

```php
$parser = new IgnorePath('', './test.txt');
echo ($parser->checkPath($array[$i]) ? "Y" : "N");
```

Rule:
```
#Test
/just/testing/dir1/*.html
!/just/testing/dir1/*.php
/just/testing/dir2/
!/just/testing/dir2/exclude.html
:i|\/just\/testing\/dir1\/\w+.jpg
!:i|\/just\/testing\/dir1\/\d+.jpg
:i|\/just\/testing\/dir\D+
```


Test Path:
```
/just/1.jpg                     // 
/just/testing/dirA/             // Ignore
/just/testing/dir3/             // 
/just/testing/dir1/             // 
/just/testing/dir1/1.html       // Ignore
/just/testing/dir1/1.php        // 
/just/testing/dir1/123.jpg      // 
/just/testing/dir1/abc.jpg      // Ignore
/just/testing/dir2/             // Ignore
/just/testing/dir2/exclude.html // 
/just/testing/dir2/1.html       // Ignore
```

