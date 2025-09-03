# Clean Wp Plugin Boilerplate

Plugin boilerplate for WordPress plugin developers.

This boilerplate is based on [Wordpress Create Block](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-create-block/)  and [Clean Architecture](https://www.google.com/search?q=Clean+Architecture)

It supports block development with React, ESNext, and JSX compilation.

Especially for developers who want to create a plugin with clean architecture and clean code.

It is not useful for simple and small projects.

You can use this boilerplate for large projects includes multiple post types, custom fields, custom taxonomies and more.

If you need a simple plugin, you can use [[Light Wp Plugin Boilerplate](https://github.com/Arkenon/light-wp-plugin-boilerplate)]

## Installation

The Boilerplate can be installed directly into your plugins folder.

Then follow these steps:

* change `plugin_name` to `example_me`
* change `plugin-name` to `example-me`
* change `Plugin_Name` to `Example_Me`
* change `PLUGIN_NAME` to `EXAMPLE_ME`
* change `pluginName` to `exampleMe`
* change `plugin.php` to `example-me.php`


* Install composer dependencies `composer update`


* Install dependencies `npm i`


* Update packages `npm run packages-update`


* Start plugin `npm start`


* Build for production `npm build`

## How to Register Blocks?

The boilerplate use "/src" folder to create blocks (via @wordpress-scripts package). There is a sample block in "src" folder. You can modify this ore create another custom block.

To register a block:
1) Build your blocks with the "npm run build" command (Make sure your current root is equal to the root of the plugin in the terminal) This command builds all blocks in "src" folder.
2) Go to "inc/class-plugin-name-blocks.php"
3) Register your blocks in the register_plugin_name_blocks() method via the register_block_type() function. To learn more about the Register_block_type() function, visit https://developer.wordpress.org/reference/functions/register_block_type/)

If you want to watch changes in your block you can use 'npm start' command and see the changes immediately.

## Architecture Diagram

```
clean-wp-plugin-boilerplate/
│
├── composer.json                           # Composer dependencies and autoload
├── plugin.php                              # Main plugin file, bootstrap ve hooks (convert this to your-plugin-name.php)
├── uninstall.php                           # Plugin uninstall script
├── readme.txt                              # Documentation
│
└── src/first-block/                        # Sample Gutenberg Block (optional)
│
└── build/first-block/                      # Built assets for the sample block
│
└── includes/                               # PSR-4 autoload: PluginName\
    │
    ├── App.php                             # 🚀 Main Application Bootstrap
    │                                       # - Plugin lifecycle management
    │                                       # - Service initialization (plugins_loaded, init hooks)
    │                                       # - Run services from DI container
    │
    ├── Application/                        # 📋 APPLICATION LAYER (Use Cases & Business Logic)
    │   ├── DTOs/                           # Data Transfer Objects
    │   │   ├── Comment/
    │   │   │   └── CommentDto.php          # DTO of generic Comment entity (for core WordPress comments)
    │   │   ├── Post/
    │   │   │   ├── PostDto.php             # DTO of generic Post entity (for core WordPress posts and post types)
    │   │   │   └── BookDto.php             # Sample: Book custom post type DTO (extends PostDto)
    │   │   ├── Taxonomy/
    │   │   │   └── TaxonomyDto.php         # DTO of generic Taxonomy entity (for core WordPress taxonomies)
    │   │   └── User/
    │   │       └── UserDto.php             # DTO of generic User entity (for core WordPress users)
    │   │
    │   ├── Interfaces/                         # Service Interfaces
    │   │   ├── BookServiceInterface.php        # Interface for Book post type  (sample custom post type)
    │   │   ├── CommentServiceInterface.php     # Interface for generic Comments
    │   │   ├── PostServiceInterface.php        # Interface for generic Posts
    │   │   ├── TaxonomyServiceInterface.php    # Interface for generic Taxonomies
    │   │   └── UserServiceInterface.php        # Interface for generic Users
    │   │
    │   └── Services/                       # Business Logic Implementation
    │       ├── BookService.php             # Book business logic + Implements BookServiceInterface
    │       ├── CommentService.php          # Comment business logic (generic)
    │       ├── PostService.php             # POst business logic (generic)
    │       ├── TaxonomyService.php         # Taxonomy business logic (generic)
    │       └── UserService.php             # User business logic (generic)
    │
    ├── Domain/                         # 🏛️ DOMAIN LAYER (Core Models & Interfaces)
    │   ├── Models/                     # Domain Models (Business Entities)
    │   │   ├── Book.php                # Book entity (extends Post) (sample custom post type)
    │   │   ├── Comment.php             # Comment entity
    │   │   ├── Post.php                # Post entity
    │   │   ├── Taxonomy.php            # Taxonomy entity
    │   │   └── User.php                # User entity
    │   │
    │   └── Repositories/                           # Repository Interfaces (Data Access Contracts)
    │       ├── BookRepositoryInterface.php         # Book data access contract
    │       ├── CommentRepositoryInterface.php      # Comment data access contract
    │       ├── PostRepositoryInterface.php         # Post data access contract
    │       ├── TaxonomyRepositoryInterface.php     # Taxonomy data access contract
    │       └── UserRepositoryInterface.php         # User data access contract
    │
    ├── Infrastructure/                     # 🔧 INFRASTRUCTURE LAYER (External Concerns)
    │   ├── CustomFields/                   # WordPress Custom Field Implementations
    │   │   └── Book/
    │   │       └── CustomFieldISBN.php     # ISBN meta field for Book post type
    │   │
    │   ├── PostTypes/                      # WordPress Custom Post Type Definitions
    │   │   └── PostTypeBook.php            # Book post type registration
    │   │
    │   ├── Taxonomies/                     # WordPress Custom Taxonomy Definitions
    │   │   └── TaxonomyGenre.php           # Genre taxonomy for books
    │   │
    │   └── Services/                       # Infrastructure Services
    │       ├── ActivationService.php       # Plugin activation logic
    │       ├── BlockService.php            # Gutenberg block registration
    │       ├── CustomFieldService.php      # Meta box management
    │       ├── DeactivationService.php     # Plugin deactivation logic
    │       ├── i18nService.php             # Internationalization
    │       ├── MailService.php             # Email service wrapper
    │       ├── PostTypeService.php         # Post type registration manager
    │       └── TaxonomyService.php         # Taxonomy registration manager
    │
    ├── Persistence/                    # 💾 PERSISTENCE LAYER (Data Storage)
    │   ├── Configurations/
    │   │   └── DI.php                  # Dependency Injection container setup
    │   │                               # - Interface to implementation bindings
    │   │                               # - Autowiring configuration
    │   │
    │   ├── Constants/
    │   │   └── Constants.php           # Plugin constants (paths, URLs, configs)
    │   │
    │   └── Repositories/                 # Repository Implementations
    │       ├── BookRepository.php        # Book data access (ISBN search)
    │       ├── CommentRepository.php     # WordPress comment API wrapper
    │       ├── PostRepository.php        # WordPress post API wrapper
    │       ├── TaxonomyRepository.php    # WordPress taxonomy API wrapper
    │       └── UserRepository.php        # WordPress user API wrapper
    │
    ├── Common/                          # 🛠️ SHARED UTILITIES
    │   ├── Helpers/
    │   │   └── Helper.php               # Sanitization ve utility functions
    │   │
    │   └── Services/                    # Shared Service Classes
    │       ├── CustomFieldBuilder.php   # Abstract meta box builder
    │       ├── Mailer.php               # Email builder pattern
    │       ├── Mapper.php               # Object-to-object mapping utility
    │       ├── PostTypeBuilder.php      # Post type registration builder
    │       └── TaxonomyBuilder.php      # Taxonomy registration builder
    │
    └── Presentation/                   # 🎨 PRESENTATION LAYER (UI & Controllers)
        ├── ControllerInit.php          # Controller initialization manager
        │                               # - Admin/Client controller routing
        │
        ├── Admin/                              # WordPress Admin Operations
        │   ├── Controllers/
        │   │   └── AdminController.php         # Admin menu, scripts, styles
        │   ├── Views/
        │   │   └── admin-menu-content.php      # Admin page template
        │   └── Assets/
        │       ├── css/plugin-name-admin.css
        │       └── js/plugin-name-admin.js
        │
        └── Client/                             # Frontend Interface
            ├── Controllers/
            │   ├── ClientController.php        # Frontend scripts ve styles
            │   └── BookController.php          # AJAX endpoints for Book operations
            └── Assets/
                ├── css/plugin-name-client.css
                └── js/plugin-name-client.js
```

## 🔄 Dependency Flow (Clean Architecture Principles):

```
Presentation Layer (Controllers, Views)
         ↓
Application Layer (Services, DTOs)
         ↓
Domain Layer (Models, Repository Interfaces)
         ↑
Infrastructure Layer (Repository Implementations)
         ↑
Persistence Layer (Database, WP API Wrappers)
```

## 📚 Detailed Explanation:

### 🚀 **App.php (Bootstrap)**
- Main entry point of the plugin
- Service lifecycle management (`plugins_loaded`, `init` hooks)
- Initialization of services through DI container

### 📋 **Application Layer**
- **DTOs**: Clean objects for data transfer between layers
- **Services**: Business logic implementation, works with domain models
- **Interfaces**: Service contracts for dependency inversion

### 🏛️ **Domain Layer (Core)**
- **Models**: Business entities, Object-oriented representation of data
- **Repository Interfaces**: Data access contracts

### 🔧 **Infrastructure Layer**
- WordPress-specific implementations (Custom Fields, Post Types, Taxonomies)
- External service integrations (Mail, Blocks)
- Framework-specific logic

### 💾 **Persistence Layer**
- **DI Container**: Dependency management with PHP-DI
- **Repositories**: Concrete data access implementations using WordPress APIs
- **Constants**: Configuration management

### 🛠️ **Common/Shared**
- **Builder Patterns**: PostType, Taxonomy, CustomField builders
- **Utilities**: Sanitization, mapping, email utilities
- Cross-cutting concerns

### 🎨 **Presentation Layer**
- **Admin Controllers**: WordPress admin area management
- **Client Controllers**: Frontend ve AJAX endpoints
- **Assets**: CSS/JS for admin and client sides

## ✨ Features:
1. **Dependency Injection**: Clean dependency management with PHP-DI
2. **Generic Types**: Template-based repository and service patterns
3. **Builder Pattern**: Fluent API for PostType, Taxonomy, CustomField
4. **Object Mapping**: Automatic mapping between domain models and DTOs
5. **Clean Separation**: Each layer with its own responsibility, loose coupling
6. **WordPress Integration**: Clean interface with native WP APIs

## Recommended Tools

### i18n Tools

The WordPress Block Plugin Boilerplate uses a variable to store the text domain used when internationalizing strings throughout the Boilerplate. To take advantage of this method, there are tools that are recommended for providing correct, translatable files:

* [Poedit](http://www.poedit.net/)
* [makepot](http://i18n.svn.wordpress.org/tools/trunk/)
* [i18n](https://github.com/grappler/i18n)

Any of the above tools should provide you with the proper tooling to internationalize the plugin.

## License

The WordPress Block Plugin Boilerplate is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

> You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

A copy of the license is included in the root of the plugin’s directory. The file is named `LICENSE`.

## Important Notes

### Licensing

The WordPress Block Plugin Boilerplate is licensed under the GPL v2 or later; however, if you opt to use third-party code that is not compatible with v2, then you may need to switch to using code that is GPL v3 compatible.

For reference, [here's a discussion](http://make.wordpress.org/themes/2013/03/04/licensing-note-apache-and-gpl/) that covers the Apache 2.0 License used by [Bootstrap](http://twitter.github.io/bootstrap/).

# Credits

Created by Kadim Gültekin

* https://github.com/Arkenon
* https://www.linkedin.com/in/kadim-gültekin-86320a198/
