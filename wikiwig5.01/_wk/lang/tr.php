<?php

////////////////////
// GLOBAL LABELS //
//////////////////

@define('WK_LABEL_LOGOUT','çikis');
@define('WK_LABEL_LINK_ADMIN','yönetici');
@define('WK_LABEL_GUEST','GuestGB');//TRADUCTION A FAIRE
@define('WK_LABEL_WIKI_MAP','Wiki Harita');
@define('WK_LABEL_CREATE','olustur');
@define('WK_LABEL_CANCEL','iptal');
@define('WK_LABEL_VALIDATE','onay');
@define('WK_LABEL_CLOSE_WINDOW','pencereyi kapat');
@define('WK_LABEL_GO_WIKI','wikiye git');
@define('WK_LABEL_FILE_MODIFIED_BY','Sayfa degistirildi');
@define('WK_LABEL_HOME_WIKI','Wiki Anasayfa');
@define('WK_LABEL_DIR_INDEX_ALIAS','Özet(<>)');
@define('WK_LABEL_CLICK_HERE','Burayi Tikla');
@define('WK_LABEL_EDIT_PAGE','sayfayi düzenle!');
@define('WK_LABEL_FOLDER_MAP','harita');
@define('WK_LABEL_BACK','geri');
@define('WK_ERR_STANDARD','Hata olustu.Istek gerçeklestirilemedi.');



/////////////////////////////
// WIKI LISTING (wk_list) //
///////////////////////////

@define('WK_LIST_TABLE_HEAD_FILE','sayfa');
@define('WK_LIST_TABLE_HEAD_SIZE','boyut');
@define('WK_LIST_TABLE_HEAD_DATE','tarih');
@define('WK_LIST_LOCKED_FILE','Sayfa düzenlendi');
@define('WK_LIST_INDEX_ALIAS','Ana sayfa');
@define('WK_LIST_ADD_DIR','Klasör ekle');
@define('WK_LIST_ADD_FILE','Sayfa ekle');
@define('WK_LIST_DELETE_FILE','Sil');
@define('WK_LIST_DELETE_FILE_TOOLTIP','Seçili sayfayi sil');
@define('WK_LIST_MOVE_FILE','Tasi');
@define('WK_LIST_MOVE_FILE_TOOLTIP','Seçili sayfayi tasi');
@define('WK_LIST_SELECT_FILE','Sayfayi seç ve islemi gerçeklestirmek için yukaridaki yada asagidaki butonu kullan');
@define('WK_LIST_SELECT_ALL_FILES','Tümünü seç / seçimi iptal et');
@define('WK_LIST_WARN_ON_DELETE_ALL_PAGES','Tüm sayfayi sil?');
@define('WK_LIST_DELETE_FOLDER','Sil');
@define('WK_LIST_DELETE_FOLDER_TOOLTIP','Seçili klasörü sil');
@define('WK_LIST_MOVE_FOLDER','Tasi');
@define('WK_LIST_MOVE_FOLDER_TOOLTIP','Seçili klasörü tasi');
@define('WK_LIST_WARN_ON_DELETE_FOLDER','Seçili klasörü sil?');



////////////////////////////////
// PAGE EDITION (wk_edition) //
//////////////////////////////

@define('WK_ERR_PAGE_ALREADY_EDITED','Bu sistemde bir sayfanýn ayný anda birden fazla kullanýcý tarafýndan kullanýlmasý tavsiye edilmez. X dakika boyunca deðiþtirdiðiniz sayfayý kaydetmezseniz, sayfa baþka bir kullanýcý tarafýndan deðiþtirilecek duruma gelir.');
@define('WK_EDITION_TITLE_PAGE','"%s" Sayfasýný Düzenle');
@define('WK_EDITION_ACTION_SAVE','Kaydet');
@define('WK_EDITION_ACTION_QUIT','Çik');
@define('WK_EDITION_MESSAGE_SAVING','Kaydediliyor...');
@define('WK_EDITION_MESSAGE_LOADING','Açiliyor...');
@define('WK_EDITION_MESSAGE_CACHING','Not:Ilk düzenlemenin kaydedilmesi uzun sürebilir');
@define('WK_EDITION_MESSAGE_PLEASE_WAIT','lütfen bekleyiniz');

@define('WK_EDITION_MESSAGE_SESSION_WARNING','Uyari:Sadece "%s" saniyeniz var '.

                      'sayfayi düzenlemeye devam etmek için kaydedin.');

@define('WK_EDITION_MESSAGE_SESSION_EXPIRED','<p>Üzgünüm! Sayfayi kaydetmediginiz için düzenleyemezsiniz '.

    '<br>Tüm kullanicilar sayafayi kullanabilir'. 

    'bazi kullanicilar degisiklik yapabilir'.
	
	'</p><p>Eger yaptiginiz degisiklikleri kaybetmek istemiyorsaniz'.
	
	'bu sayfayi baska bir düzenleme penceresinde açabilir'.
	
	' ve degisikliklerinizi kopyala/yapistir yapabilirsiniz</p>');

@define('WK_GO_WIKIWIG_MAP','Haritaya geridön');
@define('WK_EDITION_ACTION_REOPEN','Sayfayi düzenlemek için aç');
@define('WK_EDITION_CLOSE_MESSAGE','Mesaji kapat');
@define('WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO','Bu sistemde bir sayfanýn ayný anda birden fazla kullanýcý tarafýndan kullanýlmasý tavsiye edilmez. X dakika boyunca deðiþtirdiðiniz sayfayý kaydetmezseniz, sayfa baþka bir kullanýcý tarafýndan deðiþtirilecek duruma gelir.');
@define('WK_EDITION_FILE_PERIME','Sayfa tarihi');
@define('WK_EDITION_MESSAGE_ASK_SAVE','Kaydetmek istiyormusunuz?');
@define('WK_EDITION_MESSAGE_ASK_QUIT','Çikmak istiyormusunuz?');
@define('WK_EDITION_WARNING_OLD_BROWSER','Uyari:Tarayiciniz eski versiyon oldugundan metin editörünün bütün özelliklerini görüntüleyemezsiniz.');


////////////////
// DIRECTORY //
//////////////

// DIR Action Pages

@define('WK_CREATE_DIR_HEAD_TITLE','Klasör Olustur');
@define('WK_CREATE_DIR_BODY_TITLE','Klasör ekle');
@define('WK_LABEL_NEW_DIR','Klasör Adlandir');
@define('WK_CREATE_DIR_SUCCESS','"%s" klasörü basariyla olusturuldu.');
@define('WK_CREATE_DIR_SUMMARY','');
@define('WK_DELETE_DIR_HEAD_TITLE','Klasör sil');
@define('WK_DELETE_DIR_BODY_TITLE','"%s" klasörünü sil ');
@define('WK_DELETE_DIR_SUCCESS','"%s" silindi');
@define('WK_DELETE_DIR_SUMMARY','Bir klasör siliyorsunuz!Klasörü silerken dikkat edin,herhangi bir sayfadan bu klasöre verilen her link hataya sebep olacaktir ');
@define('WK_MOVE_DIR_HEAD_TITLE','Klasör Tasi');
@define('WK_MOVE_DIR_BODY_TITLE','"%s" klasörünü tasi');
@define('WK_MOVE_DIR_SUCCESS','"%s"  "%s" klasörüne tasindi');
@define('WK_MOVE_DIR_SUMMARY','Bir wiki klasörünü baska bir yere tasiyacaksiniz. Klasör tasirken dikkat edin,herhangi bir sayfadan bu klasöre verilen her link hataya sebep olacaktir ');
@define('WK_MOVE_DIR_LABEL_TARGET','"%s" klasörünün tasinacagi yeri seçin: ');



// ERRORS

@define('WK_ERR_DIR_NOT_EXISTS','"%s" klasörü bulunamadi.');
@define('WK_ERR_DIR_EXISTS','"%s" klasörü zaten var.');
@define('WK_ERR_DIR_BADNAME','"%s" geçersiz ad.');
@define('WK_ERR_DIR_NOT_WRITABLE','"%s" yazmaya karsi korumali.');
@define('WK_ERR_DIR_PARENT_NOT_EXISTS','"%s" klasörü bulunamadi.');
@define('WK_ERR_DIR_PARENT_NOT_WRITABLE','Buraya klasör ekleyemezsiniz.');
@define('WK_ERR_DIR_MAKE','"%s" ekleme yapilamaz.');
@define('WK_ERR_DIR_DELETE_ROOT','Kök dizini silmek için izin yetkiniz yok.');
@define('WK_ERR_DIR_DELETE_LOCKS','"%s" klasörü içinde düzenlenmis sayfalar oldugundan bu klasörü silemezsiniz.');
@define('WK_ERR_DIR_MOVE_NOT_ALLOWED','Klasör tasimak için yetkiniz yok.');
@define('WK_ERR_DIR_DELETE_NOT_ALLOWED','Klasör silmek için yetkiniz yok.');



//////////////

// FILE    //

////////////

// CREATE FILE Page

@define('WK_CREATE_FILE_HEAD_TITLE','Yeni sayfa olustur');
@define('WK_CREATE_FILE_BODY_TITLE','"%s" yeni sayfa ekle');
@define('WK_LABEL_NEW_FILE','Yeni sayfayi adlandir');
@define('WK_LABEL_FILE_TEMPLATE','Tür');
@define('WK_LABEL_FILE_EMPTY_TEMPLATE','Bos(sadece baslik) ');

// FILE SAVE, LOCK, UNLOCK

@define('WK_FILE_SAVED','"%s" basarili bir sekilde kaydedildi.');
@define('WK_FILE_SAVE_TITLE','Kaydediliyor...');
@define('WK_FILE_UNLOCK_TITLE','Kapatiliyor...');

// ERRORS

@define('WK_ERR_FILE_EXISTS','"%s" zaten var.');
@define('WK_ERR_FILE_NOT_EXISTS','"%s" bulunamadi.');
@define('WK_ERR_FILE_BADNAME','"%s" geçersiz ad.');
@define('WK_ERR_FILE_WRITE','"%s" yazmaya karsi korumali sayfa!!');
@define('WK_ERR_FILE_READ','"%s" okumaya karsi korumali sayfa  !!');
@define('WK_ERR_FILE_DELETE','"%s" silmeye karsi korumali sayfa  !!.');
@define('WK_ERR_READ_TPL_FILE','Sablon kullanilamaz sayfa: "%s"!');



///////////////

// DATABASE //

/////////////

@define('DB_ERR_EXTENSION_UNAVAILABLE','"%s" kullanilamaz dosya türü.Lütfen PHP yapisini kullanin.');
@define('DB_ERR_CONNECT_SERVER','"%s" sunucuya baglanilamiyor.');
@define('DB_ERR_CONNECT_DATABASE','"%s" veritabanina baglanilamiyor.');
@define('DB_ERR_QUERY_FAILED','SQL istegi basarisiz: <br/>"%s".');

///////////////////
// USER PROFILE //
/////////////////
@define('WK_PROFILE_PSEUDO_USED','Bu kullanici adi zaten var.Eger bu kullanici sizseniz sifrenizi girin.<br/>Aksi takdirde baska bir kullanici adi seçin ve sifre alanini doldurmayin.');
@define('WK_PROFILE_CREATE_INSTRUCTIONS','Profilinizi olusturmak için formu doldurun.');
'Profil Wikiwig kullanýcýlarýnýn tercih ettiði deðiþim iþlevlerini hatýrlamak için kullanýcak(örneðin; seçilen yazý rengi)<br> sayfada yapýlan herhangi bir deðiþim için kullanýcý uyarýlýr.<br>Sayfada yapýlamayan herhangi deðiþiklik için yöneticiye ulaþabilirsiniz.');
@define('WK_PROFILE_LABEL_NAME','Ad');
@define('WK_PROFILE_LABEL_PASSWORD','Sifre');
@define('WK_PROFILE_LABEL_PASSWORD_VERIF','Sifre');
@define('WK_PROFILE_PSEUDO_USED_TITLE','Kullanici adi baskasi tarafindan kullaniliyor..Lütfen baska bir ad seçin .');
@define('WK_PROFILE_CREATION_ERROR','Profil olusturulurken hata olustu');
@define('WK_PROFILE_UPDATE_TITLE','Profil Güncelleme');





/////////////////
// ADMIN      //
///////////////

@define('WK_ADMIN_HOME_MSG','Wikiwig yönetim bölümündesiniz.<br/> Sol taraftaki menüde kullanilabilir islemler listesi bulunuyor.');
@define('WK_LABEL_CONFIGURATION','Wikiwig ayarlarini güncelle');
@define('WK_LABEL_PARSING','Tüm sayfalari yorumla');
@define('WK_ADMIN_BODY_TITLE','WK Yönetici');
@define('WK_ADMIN_HEAD_TITLE','WK Yönetici');
@define('WK_ADMIN_RESULTS_TITLE','Sonuçlar');
@define('WK_ADMIN_PARSE_FILE_OK','<strong> "%s" </strong> dosyasi basariyla yorumlandi.');
@define('WK_ADMIN_PARSE_FILE_ERROR','<strong> "%s" </strong> dosyasinda yorumlama hatasi!');

///////////////////////////
// ADMIN AUTHENTICATION //
///////////////////////////

@define('WK_ADMIN_AUTH_REQUIRED','Kimlik Dogrulama Istegi');
@define('WK_ADMIN_AUTH_LABEL_LOGIN','Kullanici Adi');
@define('WK_ADMIN_AUTH_LABEL_PASSWORD','Sifre');
@define('WK_ADMIN_AUTH_ERROR','Hata:Sitede bu bölüme giris için yetkiniz yok!');
@define('WK_ADMIN_AUTH_RETRY','<a href="%s">'.WK_LABEL_CLICK_HERE.'</a></strong>Girisi Tekrar Dene .');
@define('WK_ADMIN_AUTH_INSTRUCTIONS','Bu bölüme erisim için giris yapiniz!');


 // CAUTION : DO NOT ADD ANY CHARACTERS after the last line (? >), NOT EVEN A SPACE OR A CARIAGE RETURN !!!
?>