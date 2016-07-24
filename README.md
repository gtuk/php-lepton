PHPLepton
===========
A php wrapper library for Dropbox Lepton compression tool.

**This guide assumes you have Dropbox Lepton installed.**

Installation
----------- 
You can install this library with composer or include it manually in your project.

Quick start
-----------

```php
 $lepton = new Lepton('<LeptonPath>');
```

After this you can run one of two commands, compress or decompress. If the compression or decompression failed Lepton will throw an Exception, otherwise it returns TRUE.

```php
$options = array(
);

$result = $lepton->compress(
    'example.jpg',
    'example.lep',
    $options
);

$result = $lepton->decompress(
    'example.lep',
    'example.jpg',
    $options
);
```

##Available Options
```php
$options = array(
 '-unjailed',
 '-singlethread',
 '-maxchildren',
 '-preload',
 '-unkillable',
 '-allowprogressive',
 '-zlib0',
 '-timebound=<>ms',
 '-trunc=<>',
 '-memory=<>M',
 '-threadmemory=<>M',
 '-hugepages',
 '-avx2upgrade',
 '-injectsyscall={1..4}',
 '-socket',
 '-socket=<name>',
 '-listen',
 '-listen=<port>',
 '-zliblisten',
 '-zliblisten=<port>',
 '-recodememory=<>M'
);
```
  