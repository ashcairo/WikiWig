<?php

////////////////////
// GLOBAL LABELS //
//////////////////

@define('WK_LABEL_LOGOUT','�ikis');
@define('WK_LABEL_LINK_ADMIN','y�netici');
@define('WK_LABEL_GUEST','GuestGB');//TRADUCTION A FAIRE
@define('WK_LABEL_WIKI_MAP','Wiki Harita');
@define('WK_LABEL_CREATE','olustur');
@define('WK_LABEL_CANCEL','iptal');
@define('WK_LABEL_VALIDATE','onay');
@define('WK_LABEL_CLOSE_WINDOW','pencereyi kapat');
@define('WK_LABEL_GO_WIKI','wikiye git');
@define('WK_LABEL_FILE_MODIFIED_BY','Sayfa degistirildi');
@define('WK_LABEL_HOME_WIKI','Wiki Anasayfa');
@define('WK_LABEL_DIR_INDEX_ALIAS','�zet(<>)');
@define('WK_LABEL_CLICK_HERE','Burayi Tikla');
@define('WK_LABEL_EDIT_PAGE','sayfayi d�zenle!');
@define('WK_LABEL_FOLDER_MAP','harita');
@define('WK_LABEL_BACK','geri');
@define('WK_ERR_STANDARD','Hata olustu.Istek ger�eklestirilemedi.');



/////////////////////////////
// WIKI LISTING (wk_list) //
///////////////////////////

@define('WK_LIST_TABLE_HEAD_FILE','sayfa');
@define('WK_LIST_TABLE_HEAD_SIZE','boyut');
@define('WK_LIST_TABLE_HEAD_DATE','tarih');
@define('WK_LIST_LOCKED_FILE','Sayfa d�zenlendi');
@define('WK_LIST_INDEX_ALIAS','Ana sayfa');
@define('WK_LIST_ADD_DIR','Klas�r ekle');
@define('WK_LIST_ADD_FILE','Sayfa ekle');
@define('WK_LIST_DELETE_FILE','Sil');
@define('WK_LIST_DELETE_FILE_TOOLTIP','Se�ili sayfayi sil');
@define('WK_LIST_MOVE_FILE','Tasi');
@define('WK_LIST_MOVE_FILE_TOOLTIP','Se�ili sayfayi tasi');
@define('WK_LIST_SELECT_FILE','Sayfayi se� ve islemi ger�eklestirmek i�in yukaridaki yada asagidaki butonu kullan');
@define('WK_LIST_SELECT_ALL_FILES','T�m�n� se� / se�imi iptal et');
@define('WK_LIST_WARN_ON_DELETE_ALL_PAGES','T�m sayfayi sil?');
@define('WK_LIST_DELETE_FOLDER','Sil');
@define('WK_LIST_DELETE_FOLDER_TOOLTIP','Se�ili klas�r� sil');
@define('WK_LIST_MOVE_FOLDER','Tasi');
@define('WK_LIST_MOVE_FOLDER_TOOLTIP','Se�ili klas�r� tasi');
@define('WK_LIST_WARN_ON_DELETE_FOLDER','Se�ili klas�r� sil?');



////////////////////////////////
// PAGE EDITION (wk_edition) //
//////////////////////////////

@define('WK_ERR_PAGE_ALREADY_EDITED','Bu sistemde bir sayfan�n ayn� anda birden fazla kullan�c� taraf�ndan kullan�lmas� tavsiye edilmez. X dakika boyunca de�i�tirdi�iniz sayfay� kaydetmezseniz, sayfa ba�ka bir kullan�c� taraf�ndan de�i�tirilecek duruma gelir.');
@define('WK_EDITION_TITLE_PAGE','"%s" Sayfas�n� D�zenle');
@define('WK_EDITION_ACTION_SAVE','Kaydet');
@define('WK_EDITION_ACTION_QUIT','�ik');
@define('WK_EDITION_MESSAGE_SAVING','Kaydediliyor...');
@define('WK_EDITION_MESSAGE_LOADING','A�iliyor...');
@define('WK_EDITION_MESSAGE_CACHING','Not:Ilk d�zenlemenin kaydedilmesi uzun s�rebilir');
@define('WK_EDITION_MESSAGE_PLEASE_WAIT','l�tfen bekleyiniz');

@define('WK_EDITION_MESSAGE_SESSION_WARNING','Uyari:Sadece "%s" saniyeniz var '.

                      'sayfayi d�zenlemeye devam etmek i�in kaydedin.');

@define('WK_EDITION_MESSAGE_SESSION_EXPIRED','<p>�zg�n�m! Sayfayi kaydetmediginiz i�in d�zenleyemezsiniz '.

    '<br>T�m kullanicilar sayafayi kullanabilir'. 

    'bazi kullanicilar degisiklik yapabilir'.
	
	'</p><p>Eger yaptiginiz degisiklikleri kaybetmek istemiyorsaniz'.
	
	'bu sayfayi baska bir d�zenleme penceresinde a�abilir'.
	
	' ve degisikliklerinizi kopyala/yapistir yapabilirsiniz</p>');

@define('WK_GO_WIKIWIG_MAP','Haritaya gerid�n');
@define('WK_EDITION_ACTION_REOPEN','Sayfayi d�zenlemek i�in a�');
@define('WK_EDITION_CLOSE_MESSAGE','Mesaji kapat');
@define('WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO','Bu sistemde bir sayfan�n ayn� anda birden fazla kullan�c� taraf�ndan kullan�lmas� tavsiye edilmez. X dakika boyunca de�i�tirdi�iniz sayfay� kaydetmezseniz, sayfa ba�ka bir kullan�c� taraf�ndan de�i�tirilecek duruma gelir.');
@define('WK_EDITION_FILE_PERIME','Sayfa tarihi');
@define('WK_EDITION_MESSAGE_ASK_SAVE','Kaydetmek istiyormusunuz?');
@define('WK_EDITION_MESSAGE_ASK_QUIT','�ikmak istiyormusunuz?');
@define('WK_EDITION_WARNING_OLD_BROWSER','Uyari:Tarayiciniz eski versiyon oldugundan metin edit�r�n�n b�t�n �zelliklerini g�r�nt�leyemezsiniz.');


////////////////
// DIRECTORY //
//////////////

// DIR Action Pages

@define('WK_CREATE_DIR_HEAD_TITLE','Klas�r Olustur');
@define('WK_CREATE_DIR_BODY_TITLE','Klas�r ekle');
@define('WK_LABEL_NEW_DIR','Klas�r Adlandir');
@define('WK_CREATE_DIR_SUCCESS','"%s" klas�r� basariyla olusturuldu.');
@define('WK_CREATE_DIR_SUMMARY','');
@define('WK_DELETE_DIR_HEAD_TITLE','Klas�r sil');
@define('WK_DELETE_DIR_BODY_TITLE','"%s" klas�r�n� sil ');
@define('WK_DELETE_DIR_SUCCESS','"%s" silindi');
@define('WK_DELETE_DIR_SUMMARY','Bir klas�r siliyorsunuz!Klas�r� silerken dikkat edin,herhangi bir sayfadan bu klas�re verilen her link hataya sebep olacaktir ');
@define('WK_MOVE_DIR_HEAD_TITLE','Klas�r Tasi');
@define('WK_MOVE_DIR_BODY_TITLE','"%s" klas�r�n� tasi');
@define('WK_MOVE_DIR_SUCCESS','"%s"  "%s" klas�r�ne tasindi');
@define('WK_MOVE_DIR_SUMMARY','Bir wiki klas�r�n� baska bir yere tasiyacaksiniz. Klas�r tasirken dikkat edin,herhangi bir sayfadan bu klas�re verilen her link hataya sebep olacaktir ');
@define('WK_MOVE_DIR_LABEL_TARGET','"%s" klas�r�n�n tasinacagi yeri se�in: ');



// ERRORS

@define('WK_ERR_DIR_NOT_EXISTS','"%s" klas�r� bulunamadi.');
@define('WK_ERR_DIR_EXISTS','"%s" klas�r� zaten var.');
@define('WK_ERR_DIR_BADNAME','"%s" ge�ersiz ad.');
@define('WK_ERR_DIR_NOT_WRITABLE','"%s" yazmaya karsi korumali.');
@define('WK_ERR_DIR_PARENT_NOT_EXISTS','"%s" klas�r� bulunamadi.');
@define('WK_ERR_DIR_PARENT_NOT_WRITABLE','Buraya klas�r ekleyemezsiniz.');
@define('WK_ERR_DIR_MAKE','"%s" ekleme yapilamaz.');
@define('WK_ERR_DIR_DELETE_ROOT','K�k dizini silmek i�in izin yetkiniz yok.');
@define('WK_ERR_DIR_DELETE_LOCKS','"%s" klas�r� i�inde d�zenlenmis sayfalar oldugundan bu klas�r� silemezsiniz.');
@define('WK_ERR_DIR_MOVE_NOT_ALLOWED','Klas�r tasimak i�in yetkiniz yok.');
@define('WK_ERR_DIR_DELETE_NOT_ALLOWED','Klas�r silmek i�in yetkiniz yok.');



//////////////

// FILE    //

////////////

// CREATE FILE Page

@define('WK_CREATE_FILE_HEAD_TITLE','Yeni sayfa olustur');
@define('WK_CREATE_FILE_BODY_TITLE','"%s" yeni sayfa ekle');
@define('WK_LABEL_NEW_FILE','Yeni sayfayi adlandir');
@define('WK_LABEL_FILE_TEMPLATE','T�r');
@define('WK_LABEL_FILE_EMPTY_TEMPLATE','Bos(sadece baslik) ');

// FILE SAVE, LOCK, UNLOCK

@define('WK_FILE_SAVED','"%s" basarili bir sekilde kaydedildi.');
@define('WK_FILE_SAVE_TITLE','Kaydediliyor...');
@define('WK_FILE_UNLOCK_TITLE','Kapatiliyor...');

// ERRORS

@define('WK_ERR_FILE_EXISTS','"%s" zaten var.');
@define('WK_ERR_FILE_NOT_EXISTS','"%s" bulunamadi.');
@define('WK_ERR_FILE_BADNAME','"%s" ge�ersiz ad.');
@define('WK_ERR_FILE_WRITE','"%s" yazmaya karsi korumali sayfa!!');
@define('WK_ERR_FILE_READ','"%s" okumaya karsi korumali sayfa  !!');
@define('WK_ERR_FILE_DELETE','"%s" silmeye karsi korumali sayfa  !!.');
@define('WK_ERR_READ_TPL_FILE','Sablon kullanilamaz sayfa: "%s"!');



///////////////

// DATABASE //

/////////////

@define('DB_ERR_EXTENSION_UNAVAILABLE','"%s" kullanilamaz dosya t�r�.L�tfen PHP yapisini kullanin.');
@define('DB_ERR_CONNECT_SERVER','"%s" sunucuya baglanilamiyor.');
@define('DB_ERR_CONNECT_DATABASE','"%s" veritabanina baglanilamiyor.');
@define('DB_ERR_QUERY_FAILED','SQL istegi basarisiz: <br/>"%s".');

///////////////////
// USER PROFILE //
/////////////////
@define('WK_PROFILE_PSEUDO_USED','Bu kullanici adi zaten var.Eger bu kullanici sizseniz sifrenizi girin.<br/>Aksi takdirde baska bir kullanici adi se�in ve sifre alanini doldurmayin.');
@define('WK_PROFILE_CREATE_INSTRUCTIONS','Profilinizi olusturmak i�in formu doldurun.');
'Profil Wikiwig kullan�c�lar�n�n tercih etti�i de�i�im i�levlerini hat�rlamak i�in kullan�cak(�rne�in; se�ilen yaz� rengi)<br> sayfada yap�lan herhangi bir de�i�im i�in kullan�c� uyar�l�r.<br>Sayfada yap�lamayan herhangi de�i�iklik i�in y�neticiye ula�abilirsiniz.');
@define('WK_PROFILE_LABEL_NAME','Ad');
@define('WK_PROFILE_LABEL_PASSWORD','Sifre');
@define('WK_PROFILE_LABEL_PASSWORD_VERIF','Sifre');
@define('WK_PROFILE_PSEUDO_USED_TITLE','Kullanici adi baskasi tarafindan kullaniliyor..L�tfen baska bir ad se�in .');
@define('WK_PROFILE_CREATION_ERROR','Profil olusturulurken hata olustu');
@define('WK_PROFILE_UPDATE_TITLE','Profil G�ncelleme');





/////////////////
// ADMIN      //
///////////////

@define('WK_ADMIN_HOME_MSG','Wikiwig y�netim b�l�m�ndesiniz.<br/> Sol taraftaki men�de kullanilabilir islemler listesi bulunuyor.');
@define('WK_LABEL_CONFIGURATION','Wikiwig ayarlarini g�ncelle');
@define('WK_LABEL_PARSING','T�m sayfalari yorumla');
@define('WK_ADMIN_BODY_TITLE','WK Y�netici');
@define('WK_ADMIN_HEAD_TITLE','WK Y�netici');
@define('WK_ADMIN_RESULTS_TITLE','Sonu�lar');
@define('WK_ADMIN_PARSE_FILE_OK','<strong> "%s" </strong> dosyasi basariyla yorumlandi.');
@define('WK_ADMIN_PARSE_FILE_ERROR','<strong> "%s" </strong> dosyasinda yorumlama hatasi!');

///////////////////////////
// ADMIN AUTHENTICATION //
///////////////////////////

@define('WK_ADMIN_AUTH_REQUIRED','Kimlik Dogrulama Istegi');
@define('WK_ADMIN_AUTH_LABEL_LOGIN','Kullanici Adi');
@define('WK_ADMIN_AUTH_LABEL_PASSWORD','Sifre');
@define('WK_ADMIN_AUTH_ERROR','Hata:Sitede bu b�l�me giris i�in yetkiniz yok!');
@define('WK_ADMIN_AUTH_RETRY','<a href="%s">'.WK_LABEL_CLICK_HERE.'</a></strong>Girisi Tekrar Dene .');
@define('WK_ADMIN_AUTH_INSTRUCTIONS','Bu b�l�me erisim i�in giris yapiniz!');


 // CAUTION : DO NOT ADD ANY CHARACTERS after the last line (? >), NOT EVEN A SPACE OR A CARIAGE RETURN !!!
?>