<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="relative bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('/images/auth/bg.jpg');">
    <div class="absolute inset-0 bg-white opacity-40"></div>

    <div class="glass bg-white/30 rounded-lg shadow-lg flex max-w-4xl w-full overflow-hidden relative z-10">
        <div class="hidden md:flex flex-1 items-center justify-center relative">
            <div class="absolute inset-0 opacity-60" style="background-color: #d5e6ed;"></div>
            <img src="<?php echo e(asset('images/auth/login.png')); ?>" alt="Illustration" class="relative w-4/4 h-auto z-10">
        </div>

        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-3xl font-bold text-black mt-4">Create an Account</h2>
            <p class="text-gray-800 font-semibold">Join us and start your journey!</p>

            <form method="POST" action="<?php echo e(route('register')); ?>" class="mt-8">
                <?php echo csrf_field(); ?>

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="John Doe" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="john@example.com" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password Input -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" name="password" placeholder="••••••••" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Confirm Password Input -->
                <div class="mb-4 relative">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Role Selection -->
                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role</label>
                    <select id="role" name="role" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        <option value="user" <?php echo e(old('role') == 'user' ? 'selected' : ''); ?>>User</option>
                        <option value="professional" <?php echo e(old('role') == 'professional' ? 'selected' : ''); ?>>Professional (Doctor)</option>
                    </select>
                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Terms and Conditions Checkbox -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="terms" class="mr-2">
                        <span class="text-gray-700">I agree to the <a href="#" class="text-blue-500 underline">terms and conditions</a>.</span>
                    </label>
                    <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded">
                    Register
                </button>
            </form>

            <!-- Link to Login Page -->
            <div class="flex mt-6">
                <span>Already have an account?</span>
                <a href="<?php echo e(route('login')); ?>" class="ml-1 text-red-500 font-bold">Sign In</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\auth\register.blade.php ENDPATH**/ ?>