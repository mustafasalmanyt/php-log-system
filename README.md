# PHP Log Sistemi

PHP uygulamaları için basit, etkili ve esnek log yönetim kütüphanesi.

## ✨ Özellikler

- **Günlük bazlı dosyalama**: Her gün için ayrı log dosyası oluşturur
- **Otomatik klasör oluşturma**: Log klasörü yoksa otomatik oluşturur
- **Zaman damgası**: Her log kaydına tarih ve saat bilgisi ekler
- **Admin modu**: Geliştirici için detaylı hata görüntüleme
- **Türkçe dil desteği**: Yerel zaman dilimi ve karakter desteği
- **Güvenlik kontrolü**: Yetkisiz erişimi engeller
- **Esnek kullanım**: Normal ve admin modları

## 🚀 Kurulum

1. `log.class.php` dosyasını projenize dahil edin:
```php
require_once 'log.class.php';
```

2. Projenizde güvenlik kontrolü tanımlayın:
```php
<?php
define("index", true); // Güvenlik için gerekli
?>
```

3. Log sistemini kullanmaya başlayın:
```php
$log = new log();
$log->write("Hata mesajı buraya yazılır");
```

## 📖 Kullanım

### Temel Kullanım

#### Normal Mod (Kullanıcı için)
```php
<?php
define("index", true);
require_once 'log.class.php';

$log = new log();
$log->write("Bir hata oluştu: Veritabanı bağlantısı başarısız");
// Kullanıcıya genel hata mesajı gösterir
?>
```

#### Admin Modu (Geliştirici için)
```php
<?php
define("index", true);
require_once 'log.class.php';

$log = new log('admin');
$log->write("SQL Hatası: SELECT * FROM users WHERE id = undefined");
// Detaylı hata bilgisini ekranda gösterir ve dosyaya kaydeder
?>
```

### Veritabanı Hataları için Kullanım
```php
try {
    $pdo = new PDO($dsn, $username, $password);
    // Veritabanı işlemleri
} catch (PDOException $e) {
    $log = new log();
    $log->write("Veritabanı Hatası: " . $e->getMessage());
}
```

### Exception Handling ile Kullanım
```php
function handleError($error) {
    $log = new log();
    $log->write("Uygulama Hatası: " . $error);
}

try {
    // Riskli kod
    throw new Exception("Bir şeyler yanlış gitti!");
} catch (Exception $e) {
    handleError($e->getMessage());
}
```

## 📁 Dosya Yapısı

Log sistemi şu yapıda çalışır:

```
/proje-klasoru/
├── log.class.php
├── logs/
│   ├── 2024-06-07.log
│   ├── 2024-06-08.log
│   └── 2024-06-09.log
└── index.php
```

### Log Dosyası Format Örneği
```
Time : 2024-06-07 14:30:25
Hata : Veritabanı bağlantısı başarısız

Time : 2024-06-07 15:45:12
Hata : Kullanıcı bulunamadı: ID = 999
```

## 🔧 Yapılandırma

### Constructor Parametreleri

| Parametre | Tip | Açıklama | Varsayılan |
|-----------|-----|----------|------------|
| `$mode` | string | Çalışma modu ('admin' veya boş) | `''` |

### Modlar

#### Normal Mod (Varsayılan)
- Hataları dosyaya kaydeder
- Kullanıcıya genel hata mesajı gösterir
- Güvenli ve temiz görünüm

#### Admin Modu
- Hataları dosyaya kaydeder
- Detaylı hata bilgisini ekranda gösterir
- Geliştirme ve debug için idealdir

## 🛡️ Güvenlik

- **Erişim Kontrolü**: `index` sabiti ile yetkisiz erişimi engeller
- **Güvenli Hata Mesajları**: Kullanıcılara sistem detaylarını göstermez
- **Dosya İzinleri**: Log klasörü için uygun izinler (0777)

## 📋 API Referansı

### Public Metodlar

#### `__construct($mode = '')`
Log sınıfını başlatır.
- **$mode**: 'admin' veya boş string

#### `write($message)`
Log mesajını dosyaya kaydeder.
- **$message**: Kaydedilecek hata mesajı

### Private Metodlar

#### `edit($log, $date, $message)`
Mevcut log dosyasına yeni kayıt ekler.

## ⚠️ Gereksinimler

- PHP 5.6 veya üzeri
- Dosya yazma izinleri
- DateTime sınıfı desteği

## 🐛 Hata Durumları

Log sistemi şu durumlarda otomatik olarak işlem yapar:

1. **Logs klasörü yoksa**: Otomatik oluşturur
2. **Dosya yazma hatası**: "Fatal Error!" mesajı gösterir
3. **İzin sorunu**: Klasör oluşturmaya çalışır

## 💡 Kullanım Örnekleri

### E-ticaret Uygulaması
```php
// Ödeme hatası
$log = new log();
$log->write("Ödeme işlemi başarısız: Kart numarası geçersiz - User ID: " . $userId);
```

### API Servisi
```php
// API çağrısı hatası
$log = new log('admin'); // Geliştirme ortamında
$log->write("API Hatası: " . $apiResponse['error'] . " - Endpoint: " . $endpoint);
```

### Form İşleme
```php
// Form validasyon hatası
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $log = new log();
    $log->write("Geçersiz email formatı: " . $email);
}
```

## 🔗 İlgili Projeler

Bu log sistemi şu projelerimde kullanılmaktadır:
- [PHP Database Kütüphanesi](https://github.com/mustafasalmanyt/php-pdo-database) - Veritabanı hata loglaması için

## 👨‍💻 Geliştirici

**Mustafa Salman YT**
- Website: [mustafa.slmn.tr](https://mustafa.slmn.tr)
- Email: mustafa@slmn.tr


## 📝 Lisans

Bu proje MIT lisansı altında yayınlanmıştır.


## 🙏 Teşekkürler

PHP topluluğuna ve açık kaynak geliştiricilere teşekkürler.
