<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'saman' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '1234' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'db' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I~UdwZQObi:oUhY9YW./`p|8~se&&Ai.dP5-/+-I>a Ua9P82Hm}V3mA{JQ fX`^' );
define( 'SECURE_AUTH_KEY',  'F>/LYK9^~!V>0J<9<wa#$h{=!=)0Kbo!9kZlmS[Wc45V07;m4@eg,B{:xFF]&N.q' );
define( 'LOGGED_IN_KEY',    '@NM~J% mphs7zj9bW]W>CjhQzx;T/yxWmUGG#kgh6)Y]>%v Gb&z)6`=%jzW(u?,' );
define( 'NONCE_KEY',        'D{=Io!ULKE*AL8T0Cm5|uZTTknq)M{z(H5^xJBr-!.jbQ~3F y>:!4X&-wkJ&ZLY' );
define( 'AUTH_SALT',        '(kj/?F)Z0+ XVo$+9g|%qdu0U+} 89I@ OTy_72r5,{O7! wN,<b%@c[,|W;}GMx' );
define( 'SECURE_AUTH_SALT', '+nP0F~QB7HJ#Bzzv{x3~scpF(4Et.Sz=lA+`NiXTHJ;MgUY!1(zn&N/ISS[$o!+I' );
define( 'LOGGED_IN_SALT',   'hvKi_cBpZNF]?,Pj5{ Nsf{b<*s(uAEc#p<<>JM9?qgmVaKPep-dIgRvdM$f#`<S' );
define( 'NONCE_SALT',       'hW6hbp)(&~m93U,4cC}/L>f_ou<aOq?MN)3T.zDB[$FoLS)@|]G}I;O~.n_]xDh1' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
