public function up(): void {
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2);
        $table->string('image')->nullable(); // Stores path to image
        $table->boolean('is_trending')->default(false);
        $table->timestamps();
    });
}