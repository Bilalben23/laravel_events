-   what rhymes with that?
-   Laravel News: Eric L. Barnes
-   Dayle Rees: Author of code happy & tech lead.
-   Jeffery Way: Creator of laracasts
-   Mohamed Said: Laravel Core Team Member.
-   https://larabelles.com/

======================

# Eloquent Model Relationships:

-   One-to-one relationship:

    -   Person having one passport.
    -   Each user has only one passport.
    -   Each passport belongs to only one user.
    -   `$this->hasOne(Model::class)`: in the parent model.
    -   `$this->belongsTo(ParentModel::class)`: in the child model.
    -   `$parentModel->relatedModel`
    -   `$relatedModel->parentModel`

-   One-to-many relationship:

    -   user can has many posts.
    -   book can borrow by many readers.
    -   `$this->hasMany(Model::class)`: in the parent model.
    -   `$this->belongsTo(ParentModel::class)`: in the child model.

-   Many-to-one relationship(Inverse of one-to-many):

    -   Many cars cars belonging to one owner.
    -   Each car belongs to one owner.
    -   an owner can have multiple cars.
    -   `$this->belongsTo(ParentModel::class)`: in the child model.

-   Many-to-Many relationship:
    -   Students can attend many classes.
    -   Many classes can attend by students.
    -   `$this->belongsToMany(Model::class)`: in both models

============================

# Eager Loading:

-   fetch the related data in advance to avoid N+1
    query problem.
-   fetch all the related data in single query rather than making separate queries for each related model.
-   using with: `Post::with('comments')->get()`: fetch all posts along with their comments in a single query. improving performance.

# Lazy Loading:

-   related models are loaded only when they are accessed or requested explicitly.

-  N+1 query problem
