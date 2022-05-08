<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('files/css/app.css')); ?>">
    <title>Pokemon</title>
</head>
<body>
    <div>
        <h1>Poke-Deck</h1>
        <section class="grid">
            <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pokemon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <div id="bg_pokemon">
                        <img src="<?php echo e($pokemon->sprites ?? ""); ?>" alt="img-<?php echo e($pokemon->name); ?>">
                    </div>
                    <div id="statis">
                        <div id="number">
                            <span>Nº <?php echo e(sprintf("%04d", $pokemon->id)); ?></span>
                        </div>
                        <div id="name">
                            <span><?php echo e(ucfirst($pokemon->name)); ?></span>
                        </div>
                        <div id="ability">
                            <?php if(isset($pokemon->types[0]->type->name)): ?>
                                <div id="one"><?php echo e(ucfirst($pokemon->types[0]->type->name ?? "")); ?></div>
                            <?php endif; ?>
                            <?php if(isset($pokemon->types[1]->type->name)): ?>
                                <div id="two"><?php echo e(ucfirst($pokemon->types[1]->type->name ?? "")); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    </div>
</body>
</html><?php /**PATH /mnt/dev/pokemon/resources/views/home.blade.php ENDPATH**/ ?>