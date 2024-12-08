<?php $__env->startSection('title', 'Appointments'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mx-auto px-4 mt-12 mb-12">
    <h1 class="text-3xl font-bold text-red-600 mb-6">Add Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-8">
        <form action="<?php echo e(route('add.appointments')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label for="hospital_name" class="block text-sm font-medium text-gray-700">Hospital Name:</label>
            <input type="text" name="hospital_name" id="hospital_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">

            <label for="hospital_address" class="block text-sm font-medium text-gray-700 mt-4">Hospital Address:</label>
            <input type="text" name="hospital_address" id="hospital_address" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">

            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mt-4">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment_date" required class="mt-1 block border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">

            <button type="submit" class="mt-4 bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-500">Add Appointment</button>
        </form>
    </div>

    <h1 class="text-3xl font-bold text-red-600 mb-4">Your Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
        <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border-b border-gray-200 py-4 flex justify-between items-center">
                <div>
                    <strong class="text-red-600"><?php echo e(Carbon\Carbon::parse($schedule->date)->format('d F Y')); ?></strong><br>
                    <strong class="text-gray-800">Hospital Name:</strong> <?php echo e($schedule->hospital->name); ?><br>
                    <strong class="text-gray-800">Hospital Address:</strong> <?php echo e($schedule->hospital->address); ?>

                </div>
                <form action="<?php echo e(route('delete.appointments', $schedule->id)); ?>" method="POST" class="ml-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-red-600 hover:text-red-500 font-semibold">Remove</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">You have no appointments.</p>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\appointments.blade.php ENDPATH**/ ?>