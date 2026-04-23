<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article ; 
use App\Models\Category ;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'user' , 
            'email' => 'user@gmail.com' , 
            'password' => bcrypt('123456'),
        ]);

        $cat1 =Category::create(['nom' => 'Laravel']);
        $cat2 =Category::create(['nom' => 'PHP']);
        $cat3 =Category::create(['nom' => 'Securite']);
        $cat4 =Category::create(['nom' => 'Web Design']);

        Article::create([
            'titre' => 'Apprendre Laravel en 2026 : Le Guide Complet',
            'contenu' => "Laravel reste le framework PHP le plus populaire en 2026. Dans cet article, nous allons explorer les nouvelles fonctionnalités de Laravel 12, notamment l'amélioration du système de routing, les nouveaux helpers Blade, et l'intégration native avec les outils d'IA. Que vous soyez débutant ou développeur expérimenté, ce guide vous accompagnera pas à pas dans la maîtrise de ce framework puissant et élégant.",
            'statut' => 'publie',
            'date_publication' => now(),
            'user_id' => $user->id,
            'category_id' => $cat1->id,
        ]);

        Article::create([
            'titre' => 'Les Nouveautés de PHP 8.4',
            'contenu' => "PHP 8.4 apporte son lot de nouveautés passionnantes pour les développeurs. Parmi les ajouts majeurs, on retrouve les property hooks, les classes en lecture seule améliorées, et de nouvelles fonctions pour manipuler les tableaux. Ces améliorations rendent le code plus propre, plus performant et plus facile à maintenir. Découvrez comment tirer parti de ces fonctionnalités dans vos projets.",
            'statut' => 'publie',
            'date_publication' => now(),
            'user_id' => $user->id,
            'category_id' => $cat2->id,
        ]);

        Article::create([
            'titre' => 'Sécuriser son Application Web : Les Bonnes Pratiques',
            'contenu' => "La sécurité est un enjeu majeur pour toute application web. Dans cet article, nous abordons les vulnérabilités les plus courantes : injections SQL, failles XSS, attaques CSRF et gestion des sessions. Nous verrons comment Laravel intègre des mécanismes de protection natifs et comment les configurer correctement pour garantir la sécurité de vos utilisateurs et de vos données.",
            'statut' => 'publie',
            'date_publication' => now(),
            'user_id' => $user->id,
            'category_id' => $cat3->id,
        ]);

        Article::create([
            'titre' => 'Tendances Web Design 2026 : Minimalisme et Animations',
            'contenu' => "Le web design en 2026 met l'accent sur le minimalisme fonctionnel et les micro-animations. Les interfaces épurées, les palettes de couleurs sobres et les transitions fluides dominent les tendances actuelles. Cet article explore les principes du design moderne, l'utilisation du glassmorphism, les typographies variables et les meilleures pratiques pour créer des expériences utilisateur mémorables.",
            'statut' => 'brouillon',
            'date_publication' => null,
            'user_id' => $user->id,
            'category_id' => $cat4->id,
        ]);

        Article::create([
            'titre' => 'Maîtriser Eloquent ORM : Relations et Requêtes Avancées',
            'contenu' => "Eloquent est l'ORM intégré de Laravel qui simplifie considérablement l'interaction avec la base de données. Dans cet article, nous explorons les relations avancées (polymorphiques, many-to-many avec pivot), les scopes locaux et globaux, ainsi que les techniques d'optimisation comme le eager loading pour éviter le problème N+1. Un guide essentiel pour tout développeur Laravel.",
            'statut' => 'publie',
            'date_publication' => now(),
            'user_id' => $user->id,
            'category_id' => $cat1->id,
        ]);

        Article::create([
            'titre' => 'Créer une API REST avec Laravel et Sanctum',
            'contenu' => "Les APIs REST sont au cœur des applications modernes. Ce tutoriel vous guide dans la création d'une API complète avec Laravel, en utilisant Sanctum pour l'authentification par tokens. Nous couvrons la structuration des routes, la validation des requêtes, les API Resources pour formater les réponses JSON, et les bonnes pratiques de versioning et de documentation.",
            'statut' => 'brouillon',
            'date_publication' => null,
            'user_id' => $user->id,
            'category_id' => $cat2->id,
        ]);

    }
}
