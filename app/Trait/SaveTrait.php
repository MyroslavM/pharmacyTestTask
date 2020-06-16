<?php

namespace App\Traits;

use App\Patient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

trait SaveTrait
{

    public $messages = [
        'required' => '',
        'unique' => 'Дане значення вже використовується',
        'min' => 'Мінімальна довжина :min символу (-ів)',
        'max' => 'Максимальна довжина :max символу (-ів)',
        'phone' => 'Перевірте правильність телефону',
        'exists' => 'Перевірте коректність',
        'email' => 'Вкажіть релаьний email',
        'case_diff' => 'Повинен містити букви різного регістра (z і Z)',
        'symbols' => 'Повинен містити хоча б 1 символ (@, /% & ^% @ #)',
        'numbers' => 'Повинен містити хоча б 1 число',
        'letters' => 'Повинен містити хоча б 1 букву',
        'confirmed' => 'Повторіть вказаний пароль нижче',
        'dimensions' => 'Зображення повинно бути квадратним',
        'mimes' => 'Неправильний формат файлу',
        'image_fix' => 'Неправильний формат файлу (imageFix)',
    ];

    public function save($model)
    {
        if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
            return $validator;
        }

        $instance = (isset($model->id) ? $model : new $model);
        if (property_exists($model, 'multiLanguageFields') && $this->multiLanguageFields) {
            $instance->multiLanguageFields = $this->multiLanguageFields;
        }
        $validated = collect($validator->validated());
//        $multiLangFields = $validated->filter(function ($value, $key) {
//            return in_array($key, $this->multiLanguageFields ?? []);
//        });
//        $locales = array_keys(\LaravelLocalization::getSupportedLocales());
//        foreach ($multiLangFields as $field => $value) {
//            $aggregatedValue = [];
//            foreach ($value as $key => $val) {
//                $aggregatedValue[$locales[$key]] = $val instanceof UploadedFile && isset($this->files[$field]) ? $val->store($this->files[$field]['path'], $this->files[$field]['disk']) : $val;
//            }
//            $instance->$field = $aggregatedValue;
//        }

        $fields = $validated->filter(function ($value, $key) {
            return !in_array($key, $this->multiLanguageFields ?? []);
        });
        foreach ($fields as $field => $value) {
            if (is_array($value)) {
                $aggregatedValue = [];
                foreach ($value as $val) {
                    $aggregatedValue[] = $val instanceof UploadedFile && isset($this->files[$field]) ? $val->store($this->files[$field]['path'], $this->files[$field]['disk']) : $val;
                }
                $instance->$field = $aggregatedValue;
                continue;
            }
            $instance->$field = $value instanceof UploadedFile && isset($this->files[$field]) ? $value->store($this->files[$field]['path'], $this->files[$field]['disk']) : $value;
        }
        $beforeCallbackResult = isset($model->id) ? $this->beforeUpdateCallback($instance) : $this->beforeCreateCallback($instance);

        $instance->save();

        $callbackResult = isset($model->id) ? $this->afterUpdateCallback($instance) : $this->afterCreateCallback($instance);

        return isset($model->id) ? $this->updateResponse($instance, $callbackResult) : $this->createResponse($instance, $callbackResult);
    }

    public function validateRequest()
    {
        $validator = Validator::make(request()->all(), $this->prepareFormRules(), $this->messages);
        if ($validator->fails()) {
            return request()->ajax() ? response(['status' => 0, 'errors' => ($this->firstError ?? null) ? $validator->getMessageBag()->first() : $validator->errors()]) : back()->withErrors($validator)->withInput();
        }

        return $validator;
    }

    private function prepareFormRules()
    {
        $formRules = [];
        foreach ($this->form as $field => $rules) {
            foreach ($rules as $rule => $value) {
                if (is_string($value)) {
                    $formRules[$field][] = is_numeric($rule) ? $value : $rule . ':' . $value;
                    continue;
                }
                $formRules[$field][] = $value;
            }
        }

        return $formRules;
    }

    public function beforeUpdateCallback($instance)
    {
        return $instance;
    }

    public function beforeCreateCallback($instance)
    {
        return $instance;
    }

    public function afterUpdateCallback($instance)
    {
        return $instance;
    }

    public function afterCreateCallback($instance)
    {
        return $instance;
    }

    public function updateResponse($instance, $callbackResult)
    {
        return request()->ajax() ? response(['status' => 1, 'message' => 'Зміни збережені']) : back()->with(['status' => 1, 'message' => 'Зміни збережені']);
    }

    public function createResponse($instance, $callbackResult)
    {
        return request()->ajax() ? response(['status' => 1, 'message' => 'Запис успішно створений']) : back()->with(['status' => 1, 'message' => 'Запис успішно створений']);
    }

}