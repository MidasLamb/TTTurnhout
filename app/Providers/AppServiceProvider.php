<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('printPastMatchesTable', function ($expression) {
            return '<table class="table table-striped table-bordered" >
                      <colgroup>
                        <col class="col-xs-2">
                        <col class="col-xs-4">
                        <col class="col-xs-2"> 
                        <col class="col-xs-4">
                      </colgroup>
                <?php $__currentLoopData = '.$expression.'; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td style="font-size:small; text-align:center">
                        <?php echo e($match->datumString); ?> <br>

                        <?php echo e($match->beginTijd); ?>

                        <?php echo e($match->complementaryMatch); ?>

                      </td>
                      <td style="text-align:right">
                        <?php if($match->homeGame): ?>
                          <b><a href="/ploeg/<?php echo e($match->siteid); ?>">
                        <?php endif; ?>
                        <?php echo e($match->tTNaam); ?>

                        <?php if($match->homeGame): ?>
                          </a></b>
                        <?php endif; ?>
                      </td>
                      <td 
                        <?php if($match->draw): ?>
                          style="text-align:center">
                        <?php elseif($match->victory): ?>
                          style="text-align:center; background-color: #47a35a; color: white;">
                        <?php else: ?> 
                          style="text-align:center; background-color: #ea6262; color: white;">
                        <?php endif; ?>
                      
                        <?php echo e($match->uitslag); ?>

                      </td>
                      <td style="text-align:left">
                        <?php if(!($match->homeGame)): ?>
                          <b><a href="/ploeg/<?php echo e($match->siteid); ?>">
                        <?php endif; ?>
                        <?php echo e($match->tUNaam); ?>

                        <?php if(!($match->homeGame)): ?>
                          </a></b>
                        <?php endif; ?>
                      </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </table>';
        });

        Blade::directive('printFutureMatchesTable', function ($expression) {

            return '<table class="table table-striped table-bordered table-hover"  >
                    <colgroup>
                        <col class="col-xs-2">
                        <col class="col-xs-5">
                        <col class="col-xs-5">
                      </colgroup>
                <?php $__currentLoopData = '.$expression.'; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td style="font-size:small; text-align:center">
                        <?php echo e($match->datumString); ?>
                        <?php echo "<br>"; ?>                    
                        <?php echo e($match->beginTijd); ?>

                      </td>
                      <td style="text-align:right">
                        <?php if($match->homeGame): ?>
                          <b><a href="/ploeg/<?php echo e($match->siteid); ?>">
                        <?php endif; ?>
                        <?php echo e($match->tTNaam); ?>

                        <?php if($match->homeGame): ?>
                          </a></b>
                        <?php endif; ?>
                      </td>
                      <td style="text-align:left">
                        <?php if(!($match->homeGame)): ?>
                          <b><a href="/ploeg/<?php echo e($match->siteid); ?>">
                        <?php endif; ?>
                        <?php echo e($match->tUNaam); ?>

                        <?php if(!($match->homeGame)): ?>
                          </a></b>
                        <?php endif; ?>
                      </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </table>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
