# Cabinet Dentaire

تطبيق PHP بسيط لإدارة مواعيد عيادة الأسنان، مع واجهتين:
- واجهة المريض (التسجيل، الدخول، حجز الموعد، متابعة الحالة)
- واجهة الإدارة (تأكيد/إلغاء المواعيد، إدارة المرضى، الطباعة)

## دور كل صفحة

### صفحات واجهة المريض
- `index.php`: الصفحة الرئيسية للتطبيق. تبدأ الجلسة، تتصل بقاعدة البيانات، وتحمّل `header.php` و`main.php` و`footer.php`.
- `main.php`: محتوى الصفحة الرئيسية ديناميكيًا:
  - إذا المستخدم غير مسجل الدخول: يعرض نماذج إنشاء حساب وتسجيل الدخول.
  - إذا المستخدم مسجل: يعرض نموذج حجز موعد + جدول "Mes RDV" مع خيارات الفرز والإلغاء/الطباعة.
- `signup.php`: إنشاء حساب مريض جديد بعد التحقق من عدم تكرار البريد الإلكتروني.
- `login.php`: تسجيل دخول المريض (فقط إذا كان الحساب `activation='oui'`) وتخزين بياناته في `$_SESSION`.
- `reservation.php`: حفظ موعد جديد في جدول `rdv` للمريض الحالي.
- `supp_rdv.php`: حذف موعد (من جهة المريض عادة قبل التأكيد).
- `maj_patient.php`: تعديل معلومات حساب المريض بعد إدخال كلمة المرور القديمة، ثم تسجيل الخروج.
- `imprimer.php`: إنشاء وطباعة وصل/إيصال موعد واحد (عند كونه مؤكدًا).

### صفحات الإدارة
- `admin.php`: صفحة تسجيل دخول المسؤول.
- `cpanel.php`: لوحة تحكم الإدارة، وتشمل:
  - إحصائيات (عدد المرضى، إجمالي المواعيد، المواعيد الجديدة).
  - قائمة المواعيد مع الفرز والبحث.
  - أزرار تأكيد/إلغاء الموعد.
  - قائمة المرضى مع تفعيل/تعطيل الحساب.
  - روابط طباعة المواعيد.
- `compte.php`: صفحة "mon compte" للمسؤول لتغيير اسم المستخدم وكلمة المرور بعد التحقق من كلمة المرور القديمة.
- `confirmer.php`: تحديث حالة الموعد إلى `confirmee`.
- `annuler.php`: تحديث حالة الموعد إلى `annuler`.
- `activer.php`: تفعيل حساب مريض (`activation='oui'`).
- `desactiver.php`: تعطيل حساب مريض (`activation='non'`).
- `imprimer_rdv.php`: طباعة قوائم المواعيد (كل المواعيد، مواعيد اليوم، أو بين تاريخين).

### ملفات مشتركة/مساعدة
- `connection.php`: إعداد الاتصال بقاعدة بيانات MySQL (`cabinets_dentaire`) وضبط الترميز.
- `header.php`: شريط التنقل العلوي للموقع (مع روابط حسب حالة تسجيل الدخول).
- `footer.php`: تذييل الموقع.
- `deconnecter.php`: تسجيل الخروج (تدمير الجلسة) وإعادة التوجيه إلى الصفحة الرئيسية.

## ملاحظة بنيوية
- المشروع يعتمد على `$_SESSION` لإدارة صلاحيات الوصول:
  - المريض عبر `$_SESSION['idp']`
  - المسؤول عبر `$_SESSION['ida']`

---

## استخدام jQuery

تم استخدام مكتبة jQuery لتطوير تجربة المستخدم وتفاعلية الموقع، وذلك في النقاط التالية:

### 1. إدارة نماذج الدخول والتسجيل (`main.php`):
- **إخفاء/إظهار النماذج**: عند فتح الصفحة، يتم إخفاء نموذج "إنشاء حساب" افتراضيًا.
- **تبديل النماذج بحركة انسيابية**: عند النقر على أزرار التبديل، يتم إظهار نموذج التسجيل وإخفاء نموذج الدخول (أو العكس) مع تأثير بصري يستغرق ثانيتين (`2000ms`).

### 2. تحسين واجهة المستخدم (`index.php`):
- **التنقل في الصفحة (Single Page Nav)**: لضمان انتقال سلس بين أقسام الصفحة الرئيسية.
- **تأثيرات شريط التنقل (Navbar)**: تغيير شكل شريط التنقل (إضافة فئة `active`) تلقائيًا عند تمرير الصفحة لأسفل.
- **معرض الصور (Slick Carousel)**: تهيئة وتشغيل معرض الصور بشكل متجاوب يتناسب مع حجم الشاشة.
- **التحكم في الفيديو**: إضافة وظائف تشغيل وإيقاف الفيديو (`Play/Pause`) عبر jQuery.
- **منتقي التاريخ (Datepicker)**: تسهيل عملية اختيار تاريخ الموعد من خلال واجهة رسومية.

---

## Version francaise

Application PHP simple pour la gestion des rendez-vous d'un cabinet dentaire, avec deux interfaces:
- Interface patient (inscription, connexion, reservation, suivi du statut)
- Interface administration (confirmation/annulation des rendez-vous, gestion des patients, impression)

## Role de chaque page

### Pages cote patient
- `index.php`: page principale. Demarre la session, charge la connexion base de donnees, puis inclut `header.php`, `main.php` et `footer.php`.
- `main.php`: contenu dynamique de la page d'accueil:
  - Si le patient n'est pas connecte: affiche les formulaires d'inscription et de connexion.
  - Si le patient est connecte: affiche le formulaire de reservation et la liste "Mes RDV" avec tri, annulation et impression.
- `signup.php`: cree un nouveau compte patient apres verification de l'unicite de l'email.
- `login.php`: connecte le patient (compte actif uniquement: `activation='oui'`) et enregistre les informations dans `$_SESSION`.
- `reservation.php`: ajoute un nouveau rendez-vous dans la table `rdv` pour le patient connecte.
- `supp_rdv.php`: supprime un rendez-vous (generalement avant confirmation).
- `maj_patient.php`: met a jour les informations du compte patient apres verification de l'ancien mot de passe, puis deconnecte l'utilisateur.
- `imprimer.php`: genere et imprime le recu d'un rendez-vous unique (quand il est confirme).

### Pages cote administration
- `admin.php`: page de connexion administrateur.
- `cpanel.php`: tableau de bord administrateur avec:
  - statistiques (nombre de patients, total des RDV, nouveaux RDV),
  - liste des rendez-vous avec tri et recherche,
  - actions confirmer/annuler,
  - liste des patients avec activer/desactiver,
  - options d'impression des rendez-vous.
- `compte.php`: page "mon compte" pour modifier l'utilisateur admin et le mot de passe apres verification de l'ancien mot de passe.
- `confirmer.php`: passe l'etat du rendez-vous a `confirmee`.
- `annuler.php`: passe l'etat du rendez-vous a `annuler`.
- `activer.php`: active un compte patient (`activation='oui'`).
- `desactiver.php`: desactive un compte patient (`activation='non'`).
- `imprimer_rdv.php`: imprime la liste des rendez-vous (tous, du jour, ou entre deux dates).

### Fichiers communs
- `connection.php`: configure la connexion MySQL (`cabinets_dentaire`) et le charset.
- `header.php`: barre de navigation en haut de page (liens adaptes selon la session).
- `footer.php`: pied de page.
- `deconnecter.php`: deconnexion (destruction de la session) puis redirection vers la page d'accueil.

## Note technique
- Le controle d'acces repose sur `$_SESSION`:
  - Patient via `$_SESSION['idp']`
  - Administrateur via `$_SESSION['ida']`


